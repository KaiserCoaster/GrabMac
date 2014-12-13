<?php

class Food extends Eloquent {

    protected $table = 'food';
    public $timestamps = false;
    
    public static function printGlutenFree($glutenFree)
    {
	    return ($glutenFree == -1) ? "Yes" : "No";
    }

}

?>