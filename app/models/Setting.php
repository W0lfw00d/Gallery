<?php

class Setting extends Eloquent {

	//TODO: there should be a better way to do this..
	public static function getSettings(){

		$result = Static::all();
		foreach ($result as $row) {
			$settings[$row->name] = $row->value;
		}
		return $settings;
	}
}