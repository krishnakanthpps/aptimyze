<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Test;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;

class TestController extends Controller
{

	/**
	 * Display a listing of the test.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tests = Test::latest()->get();
		return view('test.index', compact('tests'));
	}

    /**
     * Check the number of test running.
     *
     * @param Request $request
     * @return Response
     */
	public function count(Request $request)
	{
		if($request->ajax()){
			$tests = Test::where('test_running',1);
			if($tests->count()>=25){
				$old=$tests->oldest()->first();
				$time=$old->created_at->addMinutes(config('global.test_running_time'));
//				$deadline=$time->toDateTimeString();
				$deadline=$time->timestamp;
				return response()->json(['deadline'=> $deadline]);
			}
			else{
				return response()->json();
			}
		}
		else{
			return view('errors.401');
		}
	}

	/**
	 * Show the form for creating a new test.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('test.create');
	}

	/**
	 * Store a newly created test in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, ['url' => 'required|url']); // Uncomment and modify if you need to validate any input.
		$test['url']=$request->get('url');
		$test['random_string'] = mt_rand();
		$file=storage_path('AptimyzeMasterScript.jmx');
		$newFile=storage_path('test/script/'.$test['random_string'].'.jmx');

		copy($file, $newFile);

		$FileContent = file_get_contents($newFile);
		$FileContent = str_replace('http://www.jabong.com', $test['url'], $FileContent);
		file_put_contents($newFile, $FileContent);
		$test=Test::create($test);
		return response()->json(['id' => $test->id, 'url' => $test['url'], 'msg'=>trans('test.script')]);
	}

	/**
	 * Execute command to start test
	 * @param $id
	 * @return Response
	 */
	public function start($id)
	{
		$test=Test::find($id);
		$test->test_started=1;
        $test->save();
        $newFile=storage_path('test/script/'.$test->random_string.'.jmx');
		$command = "jmeter -n -t ".$newFile.' -l '.storage_path('test/log/'.$test->random_string).'.log';
		$background= "  > /dev/null 2>&1 &";
		// To allow running test in background
		ob_end_clean();
		header("Connection: close");
		ignore_user_abort(); // optional
		ob_start();
		$size = ob_get_length();
		header("Content-Length: $size");
		ob_end_flush(); // Strange behaviour, will not work
		flush();            // Unless both are called !
		exec($command. $background,$arr);
	}

	/**
	 * @param $id
	 * @return Response
	 */
	public function check($id)
	{
		$test=Test::find($id);
		$log=storage_path('test/log/'.$test->random_string).'.log';
		if(file_exists($log))
        {
            $test->test_running=1;
            $test->save();
            return response()->json(['msg'=>trans('test.started')]);
        }
		else
			return response()->json(['msg'=>trans('test.fail')]);
	}

	/**
	 * @param $id
	 * @return Response
	 */
	public function stop($id)
	{
        $test=Test::find($id);
		$background= "  > /dev/null 2>&1 &";
		exec("ps aux | grep $test->random_string | grep -v grep | awk '{ print $2 }'", $arr);
		shell_exec('kill '. $arr[1] . $background);
		return response()->json(['msg'=>trans('test.stop')]);
	}

	/**
     * To make json from log for making graph
	 * @param $id
	 * @return Response
	 */
	public function graph($id)
	{
		$test=Test::find($id);
		$handle = fopen(storage_path("test/log/$test->random_string.log"), "r");
		if ($handle) {
            // to read a single line
			for($i=0; ($line = fgets($handle)) !== false;$i++) {
                // process the line read
                $arr[$i]=explode(',' ,$line);
                // As timestamp is 13 digit but rickshaw use 10 digit so dividing by 1000
				$arr2[$i]['x']=$arr[$i][0]/1000;
				$arr2[$i]['y']=str_replace("\n",'',$arr[$i][11]);
			}
			fclose($handle);
		}
		array_multisort($arr2);
		$array=array(
        	"name" => "test",
        	"data" => $arr2
		);
		$data=json_encode($array, JSON_NUMERIC_CHECK);
		$handle2 = public_path("/resultJson/$test->random_string.json");
		file_put_contents($handle2, "[$data]");
		return response()->json(['random_string' => $test->random_string]);
	}

	/**
	 * Display the specified test.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function end($id)
	{
		$test = Test::find($id);
        $command="ps aux | grep $test->random_string | grep -v grep | awk '{ print $2 }'";
        exec($command, $arr);
        if($arr)
        {
            return response()->json();
        }
		$test->test_running = 0;
		$test->save();
		return response()->json(['msg'=>trans('test.end')]);
	}

	/**
	 * Display the specified test.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$test = Test::findOrFail($id);
		return view('test.show', compact('test'));
	}

	/**
	 * Show the form for editing the specified test.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$test = Test::findOrFail($id);
		return view('test.edit', compact('test'));
	}

	/**
	 * Update the specified test in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if you need to validate any input.
		$test = Test::findOrFail($id);
		$test->update($request->all());
		return redirect('test');
	}

	/**
	 * Remove the specified test from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Test::destroy($id);
		return redirect('test');
	}

}
