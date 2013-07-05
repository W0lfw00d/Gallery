<?php

class ContentType extends Eloquent {

	public function slides()
	{
		return $this->belongsToMany('Slide');
	}
}