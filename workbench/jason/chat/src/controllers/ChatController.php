<?php
namespace Jason\Chat\Controllers;

use Controller, Session, View, Input;
use Illuminate\Support\Facades\Redirect;

class ChatController extends Controller {

    const MAX_NUM_SLOTS = 1;

	public function getIndex()
	{
        Session::flush();

        //check if user is already registered and from other page
        if(Session::has('reminder')){
            return Redirect::to('chat/reminder');
        }
        Session::flush();

		return View::make('chat::index');
	}

    public function postBooking()
    {
        //store user into db
        $user = new \Jason\Chat\Models\User();
        $user->name = Input::get('name');
        $user->gender = Input::get('gender');

        //validate user input
        if(!$user->validate())
        {
            return Redirect::back()->withErrors($user->getErrors())->withInput();
        }

        $user->queue_number = $this->getQueueNumber(Input::get('gender'));

        $user->save();

        Session::put('chat_user', $user);

        return Redirect::to('chat/reminder');
    }


    public function getReminder()
    {
        $user = Session::get('chat_user');
        if(!isset($user)){
            return Redirect::to('chat');
        }

        //user come this page after video start, remove that user
        if(Session::has('entered')){
            Session::flush();
            return Redirect::to('chat');
        }

        \Jason\Chat\Helper::restoreUserComeBack();

        Session::put('reminder', true);


        $showTime = \Jason\Chat\Helper::getShowTimeByQueue($user->queue_number);

        $view['showTime'] = date('M d, Y, H:i:s', $showTime);
        $view['currentTime'] = date('M d, Y, H:i:s');
        $view['queue_number'] = $user->queue_number;

        $view['server'] = $_SERVER['SERVER_NAME'];
        $view['userId'] = $user->user_id;

        return View::make('chat::reminder', $view);
    }

    public function postVideo()
    {
        $user = Session::get('chat_user');
        if(!isset($user)){
            return Redirect::to('chat');
        }
        Session::put('entered', true);

        //update user info (channel id) to session
        $user = \Jason\Chat\Models\User::withTrashed()->find($user->user_id);
        Session::put('chat_user', $user);

        return View::make('chat::video');
    }

    public function postChat()
    {
        $user = Session::get('chat_user');
        if(!isset($user)){
            return Redirect::to('chat');
        }

        $data['username'] = $user->name;
        $data['channelId'] = $user->channelId;
        $data['server'] = $_SERVER['SERVER_NAME'];

        return View::make('chat::chat', $data);
    }

    public function postFinish()
    {
        $user = Session::get('chat_user');
        if(!isset($user) || !isset($user->queue_number)){
            return Redirect::to('chat');
        }

        Session::put('post-finish', true);
        return Redirect::to('chat/thank-you');
    }

    public function getThankYou()
    {
        if(Session::has('post-finish')){
            Session::flush();
        }else{

            Session::flush();
            return Redirect::to('chat');
        }
        return View::make('chat::thankyou');
    }

    public function checkSlotAvailableForOppositeGender($gender)
    {
        $genderSlots = \Jason\Chat\Models\User::where('gender', $gender)->count();
        $optGender = $gender == 'male'? 'female': 'male';
        $optGenderSlots = \Jason\Chat\Models\User::where('gender', $optGender)->count();

        if($genderSlots >= (self::MAX_NUM_SLOTS) && $optGenderSlots < self::MAX_NUM_SLOTS)//slot full for gender but not opposite gender
        {
            echo 'true';exit;
        }
        echo 'false';exit;
    }

    private function getQueueNumber($gender)
    {
        $currentQueue = \Jason\Chat\Helper::getCurrentQueue();

        $genderSlots = \Jason\Chat\Models\User::where('gender', $gender)->count();
        $queueNumber = intval($genderSlots / self::MAX_NUM_SLOTS) + $currentQueue;
        return $queueNumber;
    }



}
