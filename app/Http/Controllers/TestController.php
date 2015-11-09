<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Test;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TestController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tests = Test::latest()->get();
		return view('test.index', compact('tests'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function count(Request $request)
	{
		if($request->ajax()){
			$tests = Test::where('test_running',1);
			if($tests->count()>=25){
				$old=$tests->oldest()->first();
				$time=$old->created_at->addMinutes(10);
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
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('test.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, ['url' => 'required|url']); // Uncomment and modify if you need to validate any input.
		$data['url']=$request->get('url');
		$data['random_string'] = rand();
		$file=storage_path('AptimyzeMasterScript.jmx');
		$newFile=storage_path('test/script/'.$data['random_string'].'.jmx');
//		mkdir('../storage/test/'.$data['random_string']);

		copy($file, $newFile);

		$FileContent = file_get_contents($newFile);
		$FileContent = str_replace('http://www.jabong.com', $data['url'], $FileContent);
		file_put_contents($newFile, $FileContent);
		exec("jmeter -n -t ".$newFile.' -l '.storage_path('test/log/'.$data['random_string'].'.log'));
		$data['test_running']=1;
		Test::create($data);
//		return $random_string;
//		return exec('mkdir ../storage/$random_string');

		return response()->json(['url' => $data['url']]);
//		return $request->get('url');
	}


	public function graph()
	{
		$handle = fopen(storage_path('test/log/1968363630.log'), "r");
		if ($handle) {
			$i=0;
			while (($line = fgets($handle)) !== false) {
				$arr[$i]=explode(',' ,$line);
				// process the line read
				$arr2[$i]['x']=$arr[$i][0];
//				dd($arr2[$i]['x']);
				$arr2[$i]['y']=str_replace("\n",'',$arr[$i][11]);
//				$arr2[$i]['x']=Carbon::createFromTimestamp($arr2[$i]['x']/1000);
				$i++;
			}
			fclose($handle);
		} else {
			// error opening the file
		}
		/*$log = fgets(storage_path('test/log/1591170848.log'));
		dd($log);*/
//		dd($arr2);
		array_multisort($arr2);
		$array=array(
        	"name"=> "test",
        	"data" => $arr2
		);
		$data=json_encode($array, JSON_NUMERIC_CHECK);
//		$data=str_replace("\"", "",$data);
		$handle2 = public_path('/json/1968363630_2.json');
		file_put_contents($handle2, "[".$data."]");
//		$data=json_decode($data);
		dd($data);
		return response()->json(['data' => $data]);
	}

	public function chart()
	{
		$data= [
			['x'=>'1446799589572', 'y'=>'52'],
			['x'=>'1446799590638', 'y'=>'101'],
			['x'=>'1446799591328', 'y'=>'50']
		];
		$data=json_encode($data);
		$data_path=public_path('data_random.json');
		file_put_contents($data_path, $data);
//		dd($data);
//		$data=json_encode($data, JSON_NUMERIC_CHECK);
		return view('test.chart', compact('data'));
	}
	/**
	 * Display the specified resource.
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
	 * Show the form for editing the specified resource.
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
	 * Update the specified resource in storage.
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
	 * Remove the specified resource from storage.
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
