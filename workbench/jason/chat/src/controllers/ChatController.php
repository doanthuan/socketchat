<?php
namespace Jason\Chat\Controllers;

use Controller, Session, View, Input;
use Illuminate\Support\Facades\Redirect;

class ChatController extends Controller {

	public function getIndex()
	{
        //check if user is already registered
        if(Session::has('chat_user')){
            //display reminder

        }
		return View::make('chat::index');
	}

    public function postBooking()
    {
        //store user into db
        $user = new \Jason\Chat\Models\User();
        $user->name = Input::get('name');
        $user->gender = Input::get('gender');

        if(!$user->validate())
        {
            return Redirect::back()->withErrors($user->getErrors())->withInput();
        }
        $user->save();

        //store user into session
        Session::put('chat_user', $user);


        return Redirect::to('chat/reminder');
    }

    public function getReminder()
    {
        //check if slot is valid and display proper reminder
        //count gender person and set reminder
        $user = Session::get('chat_user');

        //count user with same gender
        $numberOfSlots = \Jason\Chat\Models\User::count();
        $queueNumber = intval($numberOfSlots / 100);

        $showTime = $this->getShowTime($queueNumber);

        $view['showTime'] = date('M d, Y, H:i:s', $showTime);

        return View::make('chat::reminder', $view);
    }

    public function getVideo()
    {
        $user = Session::get('chat_user');

        return View::make('chat::video');
    }

    public function getChat()
    {
        $user = Session::get('chat_user');

        return View::make('chat::chat');
    }

    private function getShowTime($queueNumber)
    {
        $curMin = date('i');
        $addMin = intval($curMin/30) * 30 + 30 * ($queueNumber + 1);
        $time = strtotime(date('Y-m-d H:00:00'));
        $showTime = strtotime('+'.$addMin.' minutes', $time);
        return $showTime;
    }

}
