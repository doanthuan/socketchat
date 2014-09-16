<?php
namespace Jason\Chat\Controllers;

use Controller, Session, View, Input;
use Illuminate\Support\Facades\Redirect;

class ChatController extends Controller {

    const MAX_NUM_SLOTS = 1;

	public function getIndex()
	{
        Session::flush();
        //check if user is already registered
        if(Session::has('chat_user')){
            //display reminder
            return Redirect::to('chat/reminder');
        }
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
        $currentQueue = \Jason\Chat\Models\User::pluck('queue_number');
        if(!isset($currentQueue)){
            $currentQueue = 1;
        }
        Session::put('currentQueue', $currentQueue);

        //check if slots are full
        $genderSlots = \Jason\Chat\Models\User::where('gender', Input::get('gender'))->count();
        if($genderSlots < self::MAX_NUM_SLOTS)//have slots
        {
            //find opposite sex user that does not have channel and make couple
            $optGender = Input::get('gender') == 'male'? 'female': 'male';
            $partner = \Jason\Chat\Models\User::whereNull('channelId')->where('gender', $optGender)->first();
            if($partner)
            {
                //generate channel ID
                $channelID = str_random(20);
                $partner->channelId = $channelID;
                $partner->save();

                $user->channelId = $channelID;
            }
            $user->queue_number = $currentQueue;
        }
        else
        {
            $queueNumber = $this->getQueueNumber(Input::get('gender'));
            $user->queue_number = $queueNumber;
        }

        $user->save();
        //store user into session
        Session::put('chat_user', $user);

        return Redirect::to('chat/reminder');
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


    public function getReminder()
    {
        //check if slot is valid and display proper reminder
        //count gender person and set reminder
        $user = Session::get('chat_user');
        if(!isset($user) || !isset($user->queue_number)){
            return Redirect::to('chat');
        }

        $showTime = $this->getShowTime($user->queue_number);

        if($user->queue_number > 1){
            $connectTime = $this->getShowTime($user->queue_number - 1);
        }
        else{
            $connectTime = $showTime;
        }

        $view['showTime'] = date('M d, Y, H:i:s', $showTime);
        $view['currentTime'] = date('M d, Y, H:i:s');
        $view['queue_number'] = $user->queue_number;
        $view['connectTime'] = $connectTime;

        $view['server'] = $_SERVER['SERVER_NAME'];

        return View::make('chat::reminder', $view);
    }

    public function postVideo()
    {
        $user = Session::get('chat_user');
        if(!isset($user)){
            return Redirect::to('chat');
        }

        //update user info into session before delete
        $user = \Jason\Chat\Models\User::find($user->user_id);
        Session::put('chat_user', $user);

        $user->delete();

        return View::make('chat::video');
    }

    public function postChat()
    {
        $user = Session::get('chat_user');
        if(!isset($user)){
            return Redirect::to('chat');
        }

        //make sure delete all users for this queue
        \Jason\Chat\Models\User::where('queue_number', $user->queue_number)->delete();

        $data['username'] = $user->name;
        $data['channelId'] = $user->channelId;
        $data['server'] = $_SERVER['SERVER_NAME'];

        //Session::flush();
        return View::make('chat::chat', $data);
    }

    private function getShowTime($queueNumber)
    {
        $period = 2;
        $curMin = date('i');
        $currentQueue = Session::get('currentQueue');
        $addMin = intval($curMin/$period) * $period + $period * ($queueNumber - $currentQueue + 1);
        $time = strtotime(date('Y-m-d H:00:00'));
        $showTime = strtotime('+'.$addMin.' minutes', $time);
        return $showTime;
    }

    private function getQueueNumber($gender)
    {
        $currentQueue = Session::get('currentQueue');
        $genderSlots = \Jason\Chat\Models\User::where('gender', $gender)->count();
        $queueNumber = intval($genderSlots / self::MAX_NUM_SLOTS) + $currentQueue;
        return $queueNumber;
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

}
