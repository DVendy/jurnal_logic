<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello')->with('nav', 'home');
	}

	public function iauthorMain()
	{
		return View::make('i_author.main')->with('nav', 'i_auth');
	}

	public function iauthorMission()
	{
		return View::make('i_author.mission')->with('nav', 'i_auth');
	}

	public function iauthorReview()
	{
		return View::make('i_author.review')->with('nav', 'i_auth');
	}

	public function iauthorCategories()
	{
		return View::make('i_author.categories')->with('nav', 'i_auth');
	}

	public function iauthorNot_published()
	{
		return View::make('i_author.not_published')->with('nav', 'i_auth');
	}

	public function iauthorManuscript_guidelines()
	{
		return View::make('i_author.not_published')->with('nav', 'i_auth');
	}

	public function error_404(){
		return View::make('errors.404')->with('nav', 'none');
	}
}
