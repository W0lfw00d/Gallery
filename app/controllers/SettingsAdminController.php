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
		return View::make('admin.settings')->with(array('editSettings' => $editSettings));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function store()
	{
		$settings = Input::get('setting');
		foreach($settings as $id => $value){
			$newSetting = Setting::find($id);
			$newSetting->value = $value;
			$newSetting->save();
		}
		return Redirect::to('admin/settings')->with('success',"The settings have been saved!");
	}
}