<?php

class ContactController extends \BaseController {

	public function postContactForm(){

		$rules = array('firstName' => 'required|alpha_dash',
							'lastName' => 'required|min:2|alpha_dash',
							'email' => 'required|email',
							'comment' => 'required');
		$validator = Validator::make(Input::all(), $rules);

		if($validator->passes()){
			$settings = Setting::getSettings();
			$data = array();
			$data['input'] = Input::all();
			$data['settings'] = $settings;
			$GLOBALS['data'] = $data;
			$send = Mail::send(array('emails.contactHtml', 'emails.contactText'), $data, function($message)
			{
				//TODO: find a better way to use globals
				global $data;
			    $message->to($data['settings']['email'],$data['settings']['site_name'])
			    	->subject('Email from '.$data['settings']['site_name'])
			  	  	->from($data['input']['email'],$data['input']['firstName'].' '.$data['input']['lastName']);
			});

			if($send){
				return Redirect::to('/contact')->with('success',"Thanks for the message, we'll contact you soon.");
			} else {
				return Redirect::to('/contact')->with('error',"Something went wrong. :(");
			}
		}
		//Not enough validate input go to the form again with errors
		return Redirect::to('/contact')->withInput()->withErrors($validator);
	}
}