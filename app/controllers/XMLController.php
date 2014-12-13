<?php

class XMLController extends BaseController {

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

	public function showXML()
	{
		
		$restaurants = Restaurant::all();
		$food = Food::all();
		$visits = Visit::all();
		$visitors = User::all();
		
		return View::make('xml')->with(array(
			
			'restaurants' => $restaurants,
			'food' => $food,
			'visits' => $visits,
			'visitors' => $visitors,
		));
	}
	


}
