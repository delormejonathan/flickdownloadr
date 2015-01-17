<?php

class Share extends Eloquent {
	protected $dates = array('expiration');

	public function photos()
    {
        return $this->hasMany('Photo');
    }
}
