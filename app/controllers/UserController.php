<?php

class UserController extends BaseController
{
	public function getCreate()
	{
		return View::make('user.register')->with('nav', 'account');
	}

	public function getLogin()
	{
		return View::make('user.login')->with('nav', 'account');
	}	

	public function postCreate()
	{
		$validate = Validator::make(Input::all(), array(
				'username' => 'required|unique:users|min:4',
				'pass1' => 'required|min:6',
				'pass2' => 'required|same:pass1',
			));

		if ($validate -> fails()){
			return Redirect::route('getCreate')->withErrors($validate)->withInput()->with('nav', 'account');
		}
		else{			
			$user = new User();
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('pass1'));
			
			if ($user->save()){
				return Redirect::route('home')->with('success', 'You registered successfully. You can now login.')->with('nav', 'home');
			}
			else{
				return Redirect::route('home')->with('fail', 'An error occured bro!')->with('nav', 'home');	
			}
		}
	}

	public function postLogin()
	{
		$validate = Validator::make(Input::all(), array(
				'username' => 'required',
				'pass1' => 'required',
			));

		if ($validate -> fails()){
			return Redirect::route('getLogin')->withErrors($validate)->withInput()->with('nav', 'account');
		}
		else{			
			$remember = (Input::has('remember')) ? true : false;

			$auth = Auth::attempt(array(
					'username' => Input::get('username'),
					'password' => Input::get('pass1')
				), $remember);

			if($auth){
				return Redirect::Intended('/')->with('nav', 'home');
			}
			else{
				return Redirect::route('getLogin')->with('fail', 'You entered wrong information')->with('nav', 'account');
			}
		}
	}	

	public function getLogout(){
		Auth::logout();
		return Redirect::route('home')->with('nav', 'home');
	}
}