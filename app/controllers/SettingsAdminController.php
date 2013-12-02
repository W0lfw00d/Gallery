<?php

class SettingsAdminController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$editSettings = Setting::where('editable','=',1)->get();
		$user = User::first();
		return View::make('admin.settings')->with(array('editSettings' => $editSettings,
														'user' => $user));
	}

	/**
	 * Save general settings.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function store()
	{
		//Save all the settings
		$settings = Input::get('setting');
		foreach($settings as $id => $value){
			$newSetting = Setting::find($id);
			$newSetting->value = $value;
			$newSetting->save();
		}

		//Change user/pass
		$username = Input::get('username');
		$password = Input::get('password');

		if(!empty($username)) {
			//Change the username
			$user = User::first();
			$user->name = $username;
			//Change the password
			if(!empty($password)) {
				$user->setPassword($password);
			}
			$user->save();
		}

		return Redirect::to('admin/settings')->with('success',"The settings have been saved!");
	}
}