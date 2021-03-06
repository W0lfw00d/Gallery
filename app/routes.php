<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
use Illuminate\Database\Eloquent\ModelNotFoundException;

//TODO: put this in a better location (View Composer?)
//share the settings & category menu to all views
$settings = Setting::getSettings();	
$categories = Category::where('category_id','!=',0)->orderBy('order')->get();
$siteData = array('categories'=>$categories,'settings'=>$settings);
View::share('siteData',$siteData);

//Show the index page
Route::get('/', function(){
	//TODO: build an proper index page..
	$page = Page::find(3);
	return View::make('index')->with('page',$page);
});

//Redirect to the first category
Route::get('/work', function(){
	//TODO: instead of redirect just display it
	//fetch the page should go to the first category
	$categoryId = Category::whereCategory_id(1)->orderBy('order')->first()->slug;
	$categoryId = str_replace(' ', '', $categoryId);
	return Redirect::to('/work/'.$categoryId);
});

//Route::bind('category', function($category,$route){
//	$galleryId = Category::whereName($category)->first()->id;
//	$galleries = Gallery::whereCategory_id($galleryId)->get();
//	return $galleries;
//});
Route::get('/work/{category}', function($category)
{
	//TODO: filter $category input, change it to a number (apache mapping?). Now there is a problem is the name contain a space (and special char?)
	$rules = array('category'=>'required|alpha_dash');
	$validator = Validator::make(array('category'=>$category),$rules);
	if($validator->fails()){
		return Redirect::to('/');
	}
	//fetch the requested galleries
	$category = Category::whereSlug($category)->first();
	if($category == null){
		return Redirect::to('/');
	}
	$galleries = Gallery::whereCategory_id($category->id)->orderBy('order')->get();
	
	//TODO: what is this in L4? -> Section::inject('page_title', 'injection title');
	//$test = Category::findOrFail(13);

	return $view = View::make('gallery')->with(array('categoryName'=>$category->name,
    										'galleries'=>$galleries));
	//echo '<pre>';print_r(DB::getQueryLog());

});//->where('category', '[A-Za-z0-9]+');

Route::get('/about',array(function(){

	$page = Page::find(1);

	//collect the settings
	$settings = Setting::getSettings();	

    return View::make('about')->with(array('page'=>$page,
    									'settings'=>$settings));
}));

//Display the contact form
Route::get('/contact', function()
{
	$page = Page::find(2);
	$settings = Setting::getSettings();	
	return View::make('contact')->with(array('page'=>$page,
    									'settings'=>$settings));
});
//Send the email from the contact form
Route::post('/contact', 'ContactController@postContactForm');

//Route::resource('gallery', 'GalleryController');

//Start admin part - login form
Route::get('/admin', function()
{
	return View::make('admin.login')->with('settings');
});

//process login
Route::post('/admin', function()
{
    if(Auth::attempt( 
        array(
            'name' => Input::get('username'), 
            'password' => Input::get('password')
        ) 
    )){
    	return Redirect::to('admin/category');
    }
   	return Redirect::to('admin');
});

//Admin stuff
Route::group(array('prefix' => 'admin','before'=>'auth.basic'),function(){
	Route::resource('index','IndexAdminController');
	Route::resource('theme','ThemeAdminController');
	Route::resource('category','CategoryAdminController');
	Route::post('updateCategory', 'CategoryAdminController@postUpdateCategory');
	Route::resource('gallery','GalleryAdminController');
	Route::resource('page','PageAdminController');
	Route::resource('settings','SettingsAdminController');
	
	Route::resource('images','ImageLibraryAdminController');
	Route::post('uploadImage', 'ImageLibraryAdminController@postImage');
	Route::post('deleteImage', 'ImageLibraryAdminController@postDeleteImage');
});

//Guess..
Route::get('/logout', function()
{
    Auth::logout();
    
    return Redirect::to('/');
});

//TODO: make a pretty 404 page
App::error(function(ModelNotFoundException $e)
{
    return Response::make('Not Found', 404);
});

// Display all SQL executed in Eloquent
Event::listen('illuminate.query', function($query)
{
   // var_dump($query);
});