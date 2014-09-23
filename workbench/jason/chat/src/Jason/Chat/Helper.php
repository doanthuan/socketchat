<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 9/23/14
 * Time: 2:28 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Jason\Chat;


class Helper {

    public static function getShowTimeByQueue($queueNumber)
    {
        $currentQueue = static::getCurrentQueue();
        return static::getShowTime($queueNumber - $currentQueue + 1);
    }

    public static function getShowTime($numberOfQueue = 1)
    {
        $period = 2;
        $curMin = date('i');
        $addMin = intval($curMin/$period) * $period + $period * $numberOfQueue;
        $time = strtotime(date('Y-m-d H:00:00'));
        $showTime = strtotime('+'.$addMin.' minutes', $time);
        return $showTime;
    }

    public static function getEndTime($showTime)
    {
        $addMin = 1;
        $endTime = strtotime('+'.$addMin.' minutes', $showTime);
        return $endTime;
    }

    public static function getCurrentQueue()
    {
        //current queue number in db
        $currentQueue = \Jason\Chat\Models\User::pluck('queue_number');
        if(!isset($currentQueue)){
            $currentQueue = 1;
        }
        return $currentQueue;
    }

    public static function makeCouple($currentQueue)
    {
        $maleUsers = \Jason\Chat\Models\User::where('gender', 'male')->where('queue_number', $currentQueue)->get();
        $femaleUsers = \Jason\Chat\Models\User::where('gender', 'female')->where('queue_number', $currentQueue)->get();
        $minNumUsers = count($maleUsers) > count($femaleUsers) ? count($femaleUsers): count($maleUsers);
        for($i = 0; $i < $minNumUsers; $i++){
            //generate channel ID
            $channelID = str_random(20);
            $maleUsers[$i]->channelId = $channelID;
            $maleUsers[$i]->save();

            $femaleUsers[$i]->channelId = $channelID;
            $femaleUsers[$i]->save();
        }
    }

    public static function restoreUserComeBack()
    {
        $user = \Session::get('chat_user');
        $deletedUser = \Jason\Chat\Models\User::onlyTrashed()->where('user_id', $user->user_id)->first();
        if(!$deletedUser){
            return;
        }
        $closedAt = $deletedUser->closed_at;
        $current = time();
        if($current - $closedAt > 20){
            \Session::flush();
        }
        else{
            $deletedUser->restore();
        }
    }

}