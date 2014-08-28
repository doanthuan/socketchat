<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Customer extends Model implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

    const STATUS_PENDING = 1;
    const STATUS_VERIFIED = 2;
    const STATUS_BANNED = 3;
    const STATUS_DELETED = 4;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customers';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    protected $fillable = array('first_name', 'last_name', 'email', 'phone', 'address', 'city', 'state', 'zipcode');

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
