<?php

namespace App\Http\Controllers;

use Auth;
use Mail;

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
		$this->middleware('auth', ['except' => ['create']]);
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
		return view('contact.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, ['name' => 'required',
			'email' => 'email|required',
			'phone' => array('regex: /^([0]|\+91)?[789]\d{9}$/'),
			'message' => 'required',
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

		$data['messages']=$data['message'];
//		dd($data);

		Mail::queue('emails.contact_received', $data, function($message) use ($email,$name,$subject)
		{
			$message->bcc("abhishek.bhatia@hobbyix.com","Abhishek Bhatia")->to($email, $name)->subject($subject);
		});

		$name = $data['name'];
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
		return view('contact.show', compact('contact'));
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
		return view('contact.edit', compact('contact'));
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
		return redirect('contact');
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
