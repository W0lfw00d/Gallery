<?php

class IndexAdminController extends \AdminController {

	/**
	 * Display Index settings
	 *
	 * @return Response
	 */
	public function index()
	{
		//Show all avaliable images
	    $directory = public_path().$this->settings['backgroundUploadDir'];
		$backgroundLibrary = File::glob($directory.'/*[jpg|png|gif]');
		$directory = public_path().$this->settings['foregroundUploadDir'];
		$foregroundLibrary = File::glob($directory.'/*[jpg|png|gif]');
		return View::make('admin/index')
					->with(array('backgroundLibrary'=>$backgroundLibrary,
								 'foregroundLibrary'=>$foregroundLibrary));
	}

	/**
	 * Update the index settings
	 *
	 * 
	 * @return Response
	 */
	public function store()
	{
		$background = Input::get('background');
		$foreground = Input::get('foreground');
		$setting = Setting::whereName('indexBackground')->first();
		$setting->value = $background;
		$setting->save();

		$setting = Setting::whereName('indexForeground')->first();
		$setting->value = $foreground;
		if($setting->save()){
			 // Redirect to the index edit page
        	return Redirect::to('admin/index')->with('success', 'The change have been saved');
        }
        // Redirect to the index edit page
        return Redirect::to('admin/index')->with('error', 'something went wrong :(');
	}
}