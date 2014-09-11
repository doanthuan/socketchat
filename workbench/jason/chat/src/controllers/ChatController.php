<?php
namespace Jason\Chat\Controllers;

use Controller, Session, View, Input;
use Illuminate\Support\Facades\Redirect;

class ChatController extends Controller {

	public function getIndex()
	{
        //Session::flush();
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

        //check if slots are full
        $genderSlots = \Jason\Chat\Models\User::where('gender', Input::get('gender'))->count();
        $optGender = Input::get('gender') == 'male'? 'female': 'male';
        if($genderSlots < 50)//have slots
        {
            //find opposite sex user that does not have channel and make couple
            $partner = \Jason\Chat\Models\User::whereNull('channelId')->where('gender', $optGender)->first();
            if($partner)
            {
                //generate channel ID
                $channelID = str_random(20);
                $partner->channelId = $channelID;
                $partner->save();

                $user->channelId = $channelID;
            }
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
        if($genderSlots >= 50 && $optGenderSlots < 50)//slot full for gender but not opposite gender
        {
            echo 'true';
        }
        echo 'false';
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
        $view['currentTime'] = date('M d, Y, H:i:s');

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
        $chatUser = \Jason\Chat\Models\User::find($user->user_id);

        $data['username'] = $chatUser->name;
        $data['channelId'] = $chatUser->channelId;
        $data['server'] = $_SERVER['SERVER_NAME'];

        return View::make('chat::chat', $data);
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
