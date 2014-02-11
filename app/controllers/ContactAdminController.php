<?php

class PageAdminController extends \AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$page = Page::find(2);//the contact page
		return View::make('admin.about')->with(array('page' => $page));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Redirect
	 */
	public function store()
	{
		$content = (get_magic_quotes_gpc()) ? stripslashes(Input::get('content')) : Input::get('content');
		$page = Page::find(1);
		$page->content = $content;
		$page->save();

		return Redirect::to('admin/about')->with('success',"The page has been saved!");
	}

}