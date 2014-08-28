<?php

class PublicController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		return View::make('public.index');
	}

    public function booking()
    {
        $stateList = \Goxob\Core\Helper::stateList();
        $data['stateList'] = $stateList;
        return View::make('public.booking', $data);
    }

    public function faqs()
    {
        return View::make('public.faqs');
    }

    public function locations()
    {
        return View::make('public.locations');
    }

    public function pricing()
    {
        return View::make('public.pricing');
    }

    public function contactUs()
    {
        return View::make('public.contact-us');
    }

    public function privacyPolicy()
    {
        return View::make('public.privacy-policy');
    }

    public function terms()
    {
        return View::make('public.terms');
    }

    public function bookAppointment()
    {

    }

}
