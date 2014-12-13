<?php

class RestaurantController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$restaurants = Restaurant::all();
		return View::make("restaurants.index")->with('restaurants', $restaurants);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$restaurant = Restaurant::find($id);
		
		// Count mac dishes served vs other dishes served
		$count_mac = DB::select('select COUNT(*) as num from visits where restaurantID = ? AND whichMac != ?', array($id, 0));
		$count_other = DB::select('select COUNT(*) as num from visits where restaurantID = ? AND whichMac = ?', array($id, 0));
		
		// Users with most visits
		$topEaters = DB::select("select users.firstName, users.lastName, states.name as stateName, COUNT(*) as num FROM visits, users, states WHERE visits.restaurantID = ? AND visits.userID = users.id AND users.state = states.id GROUP BY visits.userID ORDER BY num DESC LIMIT 10", array($id));
		
		// Users with most visits eating Mac and Cheese
		$topMacEaters = DB::select("select users.firstName, users.lastName, states.name as stateName, COUNT(*) as num FROM visits, users, states WHERE visits.whichMac != '0' AND visits.restaurantID = ? AND visits.userID = users.id AND users.state = states.id GROUP BY visits.userID ORDER BY num DESC LIMIT 10", array($id));
		
		return View::make("restaurants.show")->with(array(
			'restaurant' => $restaurant,
			
			'count_mac' => $count_mac[0]->num,
			'count_other' => $count_other[0]->num,
			
			'regMac' => self::macCount($id, 4),
			'baconMac' => self::macCount($id, 21),
			'lobsterMac' => self::macCount($id, 22),
			'bakedMac' => self::macCount($id, 23),
			'fourMac' => self::macCount($id, 24),
			'friedMac' => self::macCount($id, 25),
			
			'topEaters' => $topEaters,
			'topMacEaters' => $topMacEaters,
		));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	
	
	
	
	public static function macCount($id, $foodID = 0) {
		if($foodID == 0)
			$compare = "!=";
		else
			$compare = "=";
		$macCount = DB::select("select COUNT(*) as num from visits where restaurantID = ? AND whichMac " . $compare . " ?", array($id, $foodID));
		return $macCount[0]->num;
	}


}
