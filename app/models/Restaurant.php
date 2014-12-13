<?php

class Restaurant extends Eloquent {

    protected $table = 'restaurants';
    public $timestamps = false;
    
    public function stateO()
    {
        return $this->hasOne('State', 'id', 'state');
    }
    
    public static function printSellsMac($sellsMac)
    {
	    return ($sellsMac == -1) ? "Yes" : "No";
    }

}

?>