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

Route::get('/', array('uses' => 'HomeController@showHome', 'as' => 'home'));

Route::get('xml', array('uses' => 'XMLController@showXML', 'as' => 'xml'));

Route::group(array('before' => 'auth'), function() {
	
	Route::get('example', array('uses' => 'HomeController@showHome', 'as' => 'example'));
	
});


Route::resource('user', 'UserController');
Route::resource('restaurant', 'RestaurantController');
Route::resource('food', 'FoodController');
Route::resource('visit', 'VisitController');




Route::get('users', function()
{
	return "yo!";
});
