<?php

namespace App\Http\Controllers;

use Auth;
use Mail;

use App\Country;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Contacts;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ContactController extends Controller
{
	/**
	 * ContactController constructor.
	 */
	public function __construct()
	{
		$this->middleware('auth', ['except' => ['create', 'store']]);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$contacts = Contacts::latest()->get();
		return view('contact.index', compact('contacts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$countries=Country::lists('country')->all();
		array_unshift($countries,'');
		unset($countries[0]);
		$salutation=config('global.salutation');
		$test_phase=config('global.test_phase');
		$type=config('global.type');
		$load_requirement=config('global.load_requirement');
		$way=config('global.way');
		return view('contact.create', compact('countries', 'salutation', 'test_phase', 'type', 'load_requirement', 'way'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'salutation' => 'required',
			'first_name' => 'required',
			'last_name' => 'required',
			'organization' => 'required',
			'current_tool' => 'max:100',
			'email' => 'email|required',
			'phone' => array('regex: /^([0]|\+91)?[789]\d{9}$/'),
			'message' => 'required|max:2000',
			'way' => 'required',
		]);

		$data=$request->all();

		if (Auth::check())
		{
			$data['user_id']=Auth::id();
		}

		Contacts::create($data);

		$email = trans('contact.contact_email');
		$name = trans('contact.contact_email_name');
		$subject = trans('contact.contact_subject_received');

		$data['contact']=$data;
		$data['countries']=Country::lists('country');
		$data['salutation']=config('global.salutation');
		$data['test_phase']=config('global.test_phase');
		$data['type']=config('global.type');
		$data['load_requirement']=config('global.load_requirement');
		$data['way']=config('global.way');

		Mail::queue('emails.contact_received', $data, function($message) use ($email,$name,$subject)
		{
			$message->bcc("abhishek.bhatia@hobbyix.com","Abhishek Bhatia")->to($email, $name)->subject($subject);
		});

		$name = $data['first_name'];
		$email = $data['email'];
		$subject= trans('contact.contact_subject_submitted');

		Mail::queue('emails.contact_submitted', $data, function($message) use ($email, $name ,$subject)
		{
			$message->bcc("abhishek.bhatia@hobbyix.com","Abhishek Bhatia")->to($email, $name)->subject($subject);
		});

		return redirect('/')->with('success', trans('contact.contact_created'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$contact = Contacts::findOrFail($id);
		$countries=Country::lists('country');
		$salutation=config('global.salutation');
		$test_phase=config('global.test_phase');
		$type=config('global.type');
		$load_requirement=config('global.load_requirement');
		$way=config('global.way');
		return view('contact.show', compact('contact', 'countries', 'salutation','test_phase', 'type', 'load_requirement', 'way'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$contact = Contacts::findOrFail($id);
		$countries=Country::lists('country');
		$salutation=config('global.salutation');
		$test_phase=config('global.test_phase');
		$type=config('global.type');
		$load_requirement=config('global.load_requirement');
		$way=config('global.way');
		return view('contact.edit', compact('contact', 'countries', 'salutation','test_phase', 'type', 'load_requirement', 'way'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$contact = Contacts::findOrFail($id);
		$contact->update($request->all());
		return redirect('contact')->with('success', trans('contact.contact_updated'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Contacts::destroy($id);
		return redirect('contact');
	}

}
