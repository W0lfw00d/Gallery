<?php

class Category extends Eloquent {

	public function galleries()
	{
		return $this->hasMany('Gallery');
	}
/*
	public function delete()
	{
	    // also delete the attached galleries //TODO: but not the slides :(
	    $this->galleries()->delete();

	    return parent::delete();
	}
*/
}