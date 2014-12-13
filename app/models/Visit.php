<?php

class Visit extends Eloquent {

    protected $table = 'visits';
    public $timestamps = false;
    
    public function visitor()
    {
        return $this->hasOne('User', 'id', 'userID');
    }
    
    public function restaurant()
    {
        return $this->hasOne('Restaurant', 'id', 'restaurantID');
    }
    
    public function mac()
    {
	    if($this->whichMac == 0)
	    	return null;
	    	
        return $this->hasOne('Food', 'id', 'whichMac');
    }

}

?>