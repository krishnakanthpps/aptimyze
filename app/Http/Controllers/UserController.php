<?php

namespace App\Http\Controllers;

use Hash;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::latest()->get();
		return view('user.index', compact('users'));
	}

	/**
	 * Show the profile for existing user.
	 *
	 * @return Response
	 */
	public function profile()
	{
		$user_id=Auth::id();
		$user=User::find($user_id);
		return view('user.profile',compact('user'));
	}

	/**
	 * To go to "Change Password" page
	 * @return View
	 */
	public function getChangePassword()
	{
		$user_id=Auth::id();
		$user=User::find($user_id);
		return view('user.changePassword',compact('user'));
	}

	/**
	 * Logic for changing the password
	 * @param Request $request
	 * @return Routes
	 */
	public function postChangePassword(Request $request)
	{
		$id=Auth::id();
		$this->validate($request, User::$rulesChangePassword);
		$userDetails = User::find($id);
		$current_password = $request->input('current_password');
		$password = $request->input('password');
//		dd($current_password);
		if(Hash::check($current_password, $userDetails->password))
		{
			$userDetails->password = Hash::make($password);
			$userDetails->save();
			return redirect('users/profile')->with('success', trans('auth.user_password_changed'));
		}
		else
		{
			return redirect()->back()->with('failure', trans('auth.user_password_change_failed'));
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		User::create($request->all());
		return redirect('user');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);
		return view('user.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::findOrFail($id);
		return view('user.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$user = User::findOrFail($id);
		$user->update($request->all());
		return redirect('/users/profile')->with('success', trans('auth.user_update_successful'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::destroy($id);
		return redirect('user');
	}

}
