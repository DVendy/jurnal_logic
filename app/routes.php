<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' => 'HomeController@showWelcome', 'as' => 'home'));
Route::post('/asd', array('uses' => 'ArtikelController@search', 'as' => 'artikel-search'));

Route::get('/articles', array('uses' => 'ArtikelController@home', 'as' => 'artikel-home'));
Route::get('/archive', array('uses' => 'ArtikelController@archive', 'as' => 'archive-home'));
Route::get('/supplements', array('uses' => 'ArtikelController@supplements', 'as' => 'supplements'));

Route::get('/current', array('uses' => 'ArtikelController@showCurrent', 'as' => 'artikel-current'));
Route::get('/articles/show/{id}', array('uses' => 'ArtikelController@showArtikel', 'as' => 'artikel-show'));
Route::get('/archive/show/{id}', array('uses' => 'ArtikelController@showArchive', 'as' => 'archive-show'));

Route::group(array('prefix' => 'iauthor'), function()
{
    Route::get('/index', array('uses' => 'HomeController@iauthorMain', 'as' => 'i-auth-main'));
    Route::get('/mission', array('uses' => 'HomeController@iauthorMission', 'as' => 'i-auth-mission'));
    Route::get('/review', array('uses' => 'HomeController@iauthorReview', 'as' => 'i-auth-review'));
    Route::get('/categories', array('uses' => 'HomeController@iauthorCategories', 'as' => 'i-auth-categories'));
    Route::get('/not-published', array('uses' => 'HomeController@iauthorNot_published', 'as' => 'i-auth-not-published'));
    Route::get('/manuscript-guidelines', array('uses' => 'HomeController@iauthorManuscript_guidelines', 'as' => 'i-auth-manuscript-guidelines'));
});

Route::group(array('before' => 'auth'), function(){		
	Route::get('/articles/new', array('uses' => 'ArtikelController@newArtikel', 'as' => 'artikel-new'));
	Route::get('/articles/new_issue', array('uses' => 'ArtikelController@newIssue', 'as' => 'artikel-new-issue'));
	Route::get('/articles/delete/{id}', array('uses' => 'ArtikelController@deleteArtikel', 'as' => 'artikel-delete'));
	Route::post('/articles/new', array('uses' => 'ArtikelController@storeArtikel', 'as' => 'artikel-store'));
	Route::post('/articles/new_issue', array('uses' => 'ArtikelController@storeIssue', 'as' => 'artikel-store-issue'));
	Route::group(array('before' => 'csrf'), function(){
		
	});
});

Route::group(array('before' => 'csrf'), function()
{
	Route::post('/articles/download/{id}', array('uses' => 'ArtikelController@downloadArtikel', 'as' => 'artikel-download'));
});

Route::group(array('before' => 'guest'), function()
{
	Route::get('/user/create', array('uses' => 'UserController@getCreate', 'as' => 'getCreate'));
	Route::get('/user/login', array('uses' => 'UserController@getLogin', 'as' => 'getLogin'));

	Route::group(array('before' => 'csrf'), function()
	{
		Route::post('/user/create', array('uses' => 'UserController@postCreate', 'as' => 'postCreate'));
		Route::post('/user/login', array('uses' => 'UserController@postLogin', 'as' => 'postLogin'));
	});
});

Route::group(array('before' => 'auth'), function(){
	Route::get('/user/logout', array('uses' => 'UserController@getLogout', 'as' => 'getLogout'));
});

Route::get('/404', array('uses' => 'HomeController@error_404', 'as' => 'error_404'));