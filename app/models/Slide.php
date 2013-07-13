<?php

class Slide extends Eloquent {

	public function contentType()
	{
		return $this->hasOne('ContentType');
	}


	public function gallery()
	{
		return $this->belongsTo('Gallery');
	}
}