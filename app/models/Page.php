<?php

class Page extends Eloquent {

	public function contentType()
	{
		return $this->hasOne('ContentType');
	}

	public function Category()
	{
		return $this->belongsTo('Category');
	}
}