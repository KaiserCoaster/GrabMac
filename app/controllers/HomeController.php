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

	public function showHome()
	{
		
		// Gender of visitors
		$male = DB::select('select COUNT(*) as num from users where gender = ?', array(0));
		$female = DB::select('select COUNT(*) as num from users where gender = ?', array(1));
		
		
		// Gender of Mac and Cheese buyers
		$mac_male = DB::select("select COUNT(*) as num from visits, users where visits.userID = users.id AND visits.whichMac != '0' AND users.gender = ?", array(0));
		$mac_female = DB::select("select COUNT(*) as num from visits, users where visits.userID = users.id AND visits.whichMac != '0' AND users.gender = ?", array(1));
		
		// # of users
		$userCount = DB::select("select COUNT(*) as num from users");
		
		// # of restaurants
		$restCount = DB::select("select COUNT(*) as num from restaurants");
		
		// # of food items
		$foodCount = DB::select("select COUNT(*) as num from food");
		
		// # of visits
		$visitCount = DB::select("select COUNT(*) as num from visits");
		
		// Most popular day of the week (most visits on one day of the week)
		$popularDay = DB::select("select FROM_UNIXTIME(time, '%W') as day, COUNT(*) as num FROM visits GROUP BY day ORDER BY num DESC LIMIT 1");
		
		// Most popular restaurant (most visits)
		$popularRest = DB::select("select restaurants.id, restaurants.name, restaurants.city, COUNT(*) as num FROM visits, restaurants WHERE visits.restaurantID = restaurants.id GROUP BY visits.restaurantID ORDER BY num DESC LIMIT 1");
		
		// Most popular Mac and Cheese type
		$popularMac = DB::select("select food.name, COUNT(*) as num FROM visits, food WHERE visits.whichMac != '0' AND visits.whichMac = food.id GROUP BY visits.whichMac ORDER BY num DESC LIMIT 1");
		
		// State with most Mac and Cheese eaters
		$popularState = DB::select("select states.name as stateName, COUNT(*) as num FROM visits, users, states WHERE visits.whichMac != '0' AND visits.userID = users.id AND users.state = states.id GROUP BY users.state ORDER BY num DESC LIMIT 1");
		
		// Users with most visits
		$topEaters = DB::select("select users.firstName, users.lastName, states.name as stateName, COUNT(*) as num FROM visits, users, states WHERE visits.userID = users.id AND users.state = states.id GROUP BY visits.userID ORDER BY num DESC LIMIT 10");
		
		// Users with most visits eating Mac and Cheese
		$topMacEaters = DB::select("select users.firstName, users.lastName, states.name as stateName, COUNT(*) as num FROM visits, users, states WHERE visits.whichMac != '0' AND visits.userID = users.id AND users.state = states.id GROUP BY visits.userID ORDER BY num DESC LIMIT 10");
		
		return View::make('home.default')->with(array(
			'user_count' => $userCount[0]->num,
			'rest_count' => $restCount[0]->num,
			'food_count' => $foodCount[0]->num,
			'visit_count' => $visitCount[0]->num,
			'popular_day' => $popularDay[0]->day,
			'popular_rest' => $popularRest[0],
			'popular_mac' => $popularMac[0]->name,
			'popular_state' => $popularState[0]->stateName,
			
			'count_male' => $male[0]->num,
			'count_female' => $female[0]->num,
			'mac_count_male' => $mac_male[0]->num,
			'mac_count_female' => $mac_female[0]->num,
			
			'totalMacPerHour' => self::macPerHour(0),
			'regMacPerHour' => self::macPerHour(4),
			'baconMacPerHour' => self::macPerHour(21),
			'lobsterMacPerHour' => self::macPerHour(22),
			'bakedMacPerHour' => self::macPerHour(23),
			'fourCheeseMacPerHour' => self::macPerHour(24),
			'friedMacPerHour' => self::macPerHour(25),
			
			'regMac' => self::macCount(4),
			'baconMac' => self::macCount(21),
			'lobsterMac' => self::macCount(22),
			'bakedMac' => self::macCount(23),
			'fourMac' => self::macCount(24),
			'friedMac' => self::macCount(25),
			
			'totalMacPerMonth' => self::macPerMonth(0),
			
			'topEaters' => $topEaters,
			'topMacEaters' => $topMacEaters,
		));
	}
	
	// Get array of Mac and Cheese sold in each hour of the day. May specify $foodID to limit type of Mac and Cheese
	public static function macPerHour($foodID = 0) {
		if($foodID == 0)
			$compare = "!=";
		else
			$compare = "=";
		$macPerHourResult = DB::select("select COUNT(*) as num, FROM_UNIXTIME(time, '%l %p') as hour from visits where whichMac " . $compare . " ? GROUP BY FROM_UNIXTIME(time, '%k') ORDER BY FROM_UNIXTIME(time, '%H')", array($foodID));
		$macPerHour = array();
		foreach($macPerHourResult as $mac) {
			array_push($macPerHour, array(strtotime($mac->hour)*1000, intval($mac->num)));
		}
		return $macPerHour;
	}
	
	// Get array of Mac and Cheese sold in each month. May specify $foodID to limit type of Mac and Cheese
	public static function macPerMonth($foodID = 0) {
		if($foodID == 0)
			$compare = "!=";
		else
			$compare = "=";
		$macPerMonthResult = DB::select("select COUNT(*) as num, CONVERT(FROM_UNIXTIME(time, '%c'), UNSIGNED INTEGER) as month from visits where whichMac " . $compare . " ? GROUP BY FROM_UNIXTIME(time, '%c') ORDER BY month", array($foodID));
		$macPerMonth = array();
		foreach($macPerMonthResult as $mac) {
			array_push($macPerMonth, array(mktime(0,0,0,$mac->month,1)*1000, intval($mac->num)));
		}
		return $macPerMonth;
	}
	
	
	// How many dishes of a cetain Mac and Cheese type have been served.
	public static function macCount($foodID = 0) {
		if($foodID == 0)
			$compare = "!=";
		else
			$compare = "=";
		$macCount = DB::select("select COUNT(*) as num from visits where whichMac " . $compare . " ?", array($foodID));
		return $macCount[0]->num;
	}

}
