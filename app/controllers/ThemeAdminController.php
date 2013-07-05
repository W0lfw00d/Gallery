<?php

class ThemeAdminController extends \AdminController {

	/**
	 * Display Index settings
	 *
	 * @return Response
	 */
	public function index()
	{
		//Show all avaliable images
	    $directory = public_path().$this->settings['logoUploadDir'];
		$logoLibrary = File::glob($directory.'/*[jpg|png|gif]');
		return View::make('admin/theme')
					->with('logoLibrary',$logoLibrary);
	}

	/**
	 * Update the index settings
	 *
	 * 
	 * @return Response
	 */
	public function store()
	{
		$logoImage = Input::get('logo');
		$logoAlign = Input::get('logoAlignClass');
		$setting = Setting::whereName('logo')->first();
		$setting->value = $logoImage;
		$setting->save();

		$setting = Setting::whereName('logo-align-class')->first();
		$setting->value = $logoAlign;
		if($setting->save()){
			 // Redirect to the theme edit page
        	return Redirect::to('admin/theme')->with('success', 'The change have been saved');
        }
        // Redirect to the theme edit page
        return Redirect::to('admin/theme')->with('error', 'something went wrong :(');
	}
}