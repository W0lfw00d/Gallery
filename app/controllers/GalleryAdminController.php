<?php

class GalleryAdminController extends \AdminController {

	/**
	 * Display a listing of the gallery.
	 *
	 * @return Response
	 */
	public function index()
	{
		$galleries = Gallery::orderBy('order')->get();//->orderBy('category_id');
		return View::make('admin/gallery/index')->with('galleries',$galleries);
	}

	/**
	 * Show the form for creating a new gallery.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = Category::orderBy('order')->whereCategory_id(1)->lists('name', 'id');
		//Show all avaliable images
	    $directory = public_path().$this->settings['galleryUploadDir'];
		$imageLibrary = File::glob($directory.'/*[jpg|png|gif]');
		return View::make('admin/gallery/create')
						->with(array('categories'=>$categories,'imageLibrary'=>$imageLibrary));
	}

	/**
	 * Store a newly created gallery in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$name = Input::get('name');
		$info = (get_magic_quotes_gpc()) ? stripslashes(Input::get('info')) : Input::get('info');
		$caption = Input::get('caption');
		$showInfo = Input::get('show-info')=="1" ? 1 : '';
		$category_id = Input::get('category_id');
		$slideContent = Input::get('slideContent');
		$slideType = Input::get('slideType');//array

		 // Declare the rules for the form validation
        $rules = array(
            'name' => 'required|max:40',
            'category_id' => 'required|numeric'
        );

        // Validate the inputs
        $validator = Validator::make(array('name'=>$name,'category_id'=>$category_id), $rules);
		if ($validator->passes())
		{
			$gallery = new Gallery();
			$gallery->name = $name;
			$gallery->caption = $caption;
			$gallery->info = $info;
			$gallery->show_info = $showInfo;
			$gallery->category_id = $category_id;
			//$gallery->order = Gallery::whereCategory_id(1)->max('order')+1;//put it at the bottom
			//check if it's saved
			if($gallery->save()){

				//collect the newly created gallery_id
				$gallery_id = $gallery->id;
				//Flip through the slides and save them in order
				for ($i=0; $i < sizeof($slideContent); $i++) {
					$slide = new Slide();
					$slide->content = $slideContent[$i];
					$slide->contentType_id = $slideType[$i];
					$slide->gallery_id = $gallery_id;
					$slide->order = $i;
					$slide->save();
				}
				 // Redirect to the edit of category
            	return Redirect::to('admin/category/'.$category_id.'/edit')->with('success', 'Gallery "'.$gallery->name.'" has been created');
            }

            // Redirect to the gallery create 
            return Redirect::to('admin/gallery/create')->with('error', 'something went wrong :(');
        }

        // Form validation failed
        return Redirect::to('admin/gallery/create')->withInput()->withErrors($validator);
	}

	/**
	 * Display the specified gallery.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*
	public function show($id)
	{

	}
	*/

	/**
	 * Show the form for editing the specified gallery.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//Show the gallery 
		$gallery = Gallery::findOrFail($id);
		$categories = Category::orderBy('order')->whereCategory_id(1)->lists('name', 'id');
		
		//Get all avaliable images
	    $directory = public_path().$this->settings['galleryUploadDir'];
		$imageLibrary = File::glob($directory.'/*[jpg|png|gif]');

		//Put the currently used images in a nice searchable array
		$currentImages = array();
		$slides = $gallery->slides()->get();
		for ($i=0; $i < sizeof($slides); $i++) { 
			$currentImages[] = $slides[$i]->content;
		}

		$imageLibraryNew = array();
		//Filter out the images currently used in the gallery
		for ($i=0; $i < sizeof($imageLibrary); $i++) {
			$baseName = pathinfo($imageLibrary[$i],PATHINFO_BASENAME);
			if(!in_array($baseName,$currentImages)){
				$imageLibraryNew[] = $imageLibrary[$i];
			}
		}

		return View::make('admin/gallery/edit')
						->with(array('categories'=>$categories,'gallery'=>$gallery,'slides'=>$slides,'imageLibrary'=>$imageLibraryNew));
	}

	/**
	 * Update the specified gallery in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$name = Input::get('name');
		$info = (get_magic_quotes_gpc()) ? stripslashes(Input::get('info')) : Input::get('info');
		$showInfo = Input::get('show-info')=='1' ? 1 : '';
		$caption = Input::get('caption');
		$category_id = Input::get('category_id');
		$slideContent = Input::get('slideContent');//array
		$slideType = Input::get('slideType');//array

		 // Declare the rules for the form validation
        $rules = array(
            'name'  => 'required|max:40',
            'category_id'	=> 'required|numeric'
        );

        // Validate the inputs
        $validator = Validator::make(array('name'=>$name,'category_id'=>$category_id), $rules);
    	//TODO: do the is_array check in validator (custom rule?)
		if ($validator->passes() && is_array($slideContent))
		{
			$gallery = Gallery::find($id);
			$gallery->name = $name;
			$gallery->caption = $caption;
			$gallery->show_info = $showInfo;
			$gallery->info = $info;
			$gallery->category_id = $category_id;

			//Delete all the old slides before saving the new ones..
			$slides = Slide::where('gallery_id','=',$id)->delete();
			//Flip through the new slides and save them in order
			for ($i=0; $i < sizeof($slideContent); $i++) {
				$slide = new Slide();
				$slide->content = $slideContent[$i];
				$slide->contentType_id = $slideType[$i];
				$slide->gallery_id = $id;
				$slide->order = $i;
				$slide->save();
			}
			//check if it's saved
			if($gallery->save()){
				 // Redirect to the gallery list
            	return Redirect::to('admin/category/'.$category_id.'/edit')->with('success', 'The changes to gallery "'.$gallery->name.'" have been saved.');
            }
            // Redirect to the gallery edit page
            return Redirect::to('admin/gallery/'.$id.'/edit')->with('error', 'something went wrong :(');
        }
        // Form validation failed
        return Redirect::to('admin/gallery/'.$id.'/edit')->withInput()->withErrors($validator);
	}

	/**
	 * Remove the specified gallery from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        // Validate the inputs
        if(is_numeric($id))
		{
			$gallery = Gallery::find($id);
			$category_id = $gallery->category_id;
			//delete the gallery & slides
    		$gallery->delete();
    		return Redirect::to('admin/category/'.$category_id.'/edit')->with('success','Gallery has been deleted');
 		}
    	return Redirect::to('admin/category/'.$category_id.'/edit')->with('error','Gallery couldn\'t be deleted');
	}

	/**
	*
	* Upload files
	*/
	/*
	public function post_upload(){
	 
	    $input = Input::all();
	    $rules = array(
	        'file' => 'image|max:3000',
	    );
	 
	    $validation = Validator::make($input, $rules);
	 
	    if ($validation->fails())
	    {
	        return Response::make($validation->errors->first(), 400);
	    }
	 
	    $file = Input::file('file');
	 
	    $extension = File::extension($file['name']);
	    $directory = path('public').'uploads/'.sha1(time());
	    $filename = sha1(time().time()).".{$extension}";
	 
	    $upload_success = Input::upload('file', $directory, $filename);
	 
	    if( $upload_success ) {
	        return Response::json('success', 200);
	    } else {
	        return Response::json('error', 400);
	    }
	}

	*/



}