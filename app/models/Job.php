<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Job extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'job';

    protected $fillable = array('amount', 'customer_id', 'team_id', 'team_revenue', 'discount_code',  'giftcard_amount',
        'service_type', 'take_time', 'service_frequency', 'service_extras');

    public static $rules = array(
        'first_name'=>'required|alpha|min:2',
        'last_name'=>'required|alpha|min:2',
        'email'=>'required|email|unique:users',
        'password'=>'required|alpha_num|min:8|confirmed',
        'password_confirmation'=>'required|alpha_num|min:8',
        'address'=>'required|alpha',
        'city'=>'required|alpha',
        'state'=>'required|alpha',
        'zipcode'=>'required|alpha',
    );
}
