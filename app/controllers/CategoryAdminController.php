<?php

class CategoryAdminController extends \AdminController {

	/**
	 * Display a listing of the category.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = Category::whereCategory_id(1)->orderBy('order')->get();
		return View::make('admin/category/index')->with('categories',$categories);
	}

	/**
	 * Show the form for creating a new category.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin/category/create');
	}

	/**
	 * Store a newly created category in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$name = Input::get('name');
		$slug = Str::slug(Input::get('name'));

		 // Declare the rules for the form validation
        $rules = array(
            'name'  => 'required|max:40',
            'slug'	=> 'required|unique:categories,slug'
        );

        // Validate the inputs
        $validator = Validator::make(array('name'=>$name,'slug'=>$slug), $rules);
		if ($validator->passes())
		{
			$category = new Category();
			$category->name = $name;
			$category->slug = $slug;
			$category->category_id = 1;//so they become a 'work' subcategory
			$category->order = Category::whereCategory_id(1)->max('order')+1;//put it at the bottom
			//check if it's saved
			if($category->save()){
				 // Redirect to the category list
            	return Redirect::to('admin/category/'.$category->id.'/edit')->with('success', 'Category "'.$category->name.'" has been created');
            }

            // Redirect to the category create 
            return Redirect::to('admin/category/create')->with('error', 'something went wrong :(');
        }

        // Form validation failed
        return Redirect::to('admin/category/create')->withInput()->withErrors($validator);
	}

	/**
	 * Display the specified category.
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
	 * Show the form for editing the specified category.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$category = Category::findOrFail($id);
		return View::make('admin/category/edit')->with('category',$category);
	}

	/**
	 * Update the specified category in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$name = Input::get('name');
		$slug = Str::slug(Input::get('name'));
		$gallery_ids = Input::get('gallery_ids');
		$gallery_order_ids = Input::get('gallery_order_ids');

		 // Declare the rules for the form validation
        $rules = array(
            'name'  => 'required|max:40',
            'slug'	=> 'required|unique:categories,slug,'.$id
        );

        // Validate the inputs
        $validator = Validator::make(array('name'=>$name,'slug'=>$slug), $rules);
		if ($validator->passes())
		{
			$category = Category::find($id);
			$category->name = $name;
			$category->slug = $slug;

			//save the gallery order
			if(is_array($gallery_order_ids)){
				$i = 0;
				foreach ($gallery_order_ids as $gallery_id) {
					if(is_numeric($gallery_id)){
						$gallery = Gallery::findOrFail($gallery_id);
						$gallery->order = $i++;
						$gallery->save();
					}
				}
			}

			//delete the selected galleries
			if(is_array($gallery_ids)) {
				foreach ($gallery_ids as $gallery_id) {
					if(is_numeric($gallery_id)){
						Gallery::destroy($gallery_id);
					}
				}
			}

			//check if it's saved
			if($category->save()){
				 // Redirect to the category list
            	return Redirect::to('admin/category')->with('success', 'The changes to category "'.$category->name.'" have been saved.');
            }
            // Redirect to the category edit page
            return Redirect::to('admin/category/'.$id.'/edit')->with('error', 'something went wrong :(');
        }
        // Form validation failed
        return Redirect::to('admin/category/'.$id.'/edit')->withInput()->withErrors($validator);
	}

	/**
	 * Remove the specified category from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        // Validate the inputs
        if(is_numeric($id))
		{
			//TODO: fix this to also delete gallery + slides
			Category::destroy($id);
			//$category = Category::find($id);
    		//$category->delete();
    		return Redirect::to('admin/category')->with('success','Category has been deleted');
 		}
    	return Redirect::to('admin/category')->with('error','Category couldn\'t be deleted');
	}

}