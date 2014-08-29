<?php

class HomeController extends Controller {

	public function getIndex()
	{
		return View::make('chat::index');
	}

    public function booking()
    {
        //check if slot is valid
    }

}
