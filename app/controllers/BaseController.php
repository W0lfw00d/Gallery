<?php

class BaseController extends Controller {

	protected $settings;

	public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));

        //TODO: this might be double since it on top of the routes.php file  for now
        $this->settings = Setting::getSettings();
		$categories = Category::where('category_id','!=',0)->orderBy('order')->get();
		$siteData = array('categories'=>$categories,'settings'=>$this->settings);
		View::share('siteData',$siteData);
    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	
}