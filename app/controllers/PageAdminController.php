<?php

class PageAdminController extends \AdminController {

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return View
	 */
	public function edit($id)
	{
		$page = Page::find($id);//the about page
		return View::make('admin.page')->with(array('page' => $page));
	}

	/**
	 * Update the specified page in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(is_numeric($id)){
			$content = (get_magic_quotes_gpc()) ? stripslashes(Input::get('content')) : Input::get('content');
			$page = Page::find($id);
			$page->content = $content;
			$page->save();
			return Redirect::to('admin/page/'.$id.'/edit')->with('success',"The page has been saved!");
		}
		return Redirect::to('admin/page/1/edit')->with('Error',"The requested page is unknown");
	}

}