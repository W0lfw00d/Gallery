<?php

class Gallery extends Eloquent {

	public function slides()
	{
		return $this->hasMany('Slide')->orderBy('order');
	}

	public function category()
	{
		return $this->belongsTo('Category');
	}

	public function delete()
	{
	    // also delete the attached slides
	    $this->slides()->delete();

	    return parent::delete();
	}
}