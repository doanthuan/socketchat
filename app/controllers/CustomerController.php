<?php

class CustomerController extends BaseController {

    public function getLogout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::to('customer/login');
    }

    public function getLogin()
    {
        // If logged in, redirect customer
        if (Auth::check())
        {
            return Redirect::to( 'customer/profile' );
        }

        return View::make('customer.login');
    }

    public function postLogin()
    {
        $rules = array(
            'username'      =>  'required',
            'password'      =>  'required'
        );

        $loginValidator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success.
        if ( $loginValidator->passes() )
        {
            $loginDetails = array(
                'username' => Input::get('username'),
                'password' => Input::get('password'),
                'status' => User::STATUS_VERIFIED
            );

            // Try to log the user in.
            if ( Auth::attempt( $loginDetails ) )
            {
                //$user = Auth::user();
                //$user->last_login = date('Y-m-d H:i:s');
                //$user->save();

                return Redirect::to('customer/profile');
            }else{
                // Redirect to the login page.
                return Redirect::to('customer/login')->withErrors('Invalid username / password or account is not activated' )->withInput();
            }
        }

        // Something went wrong.
        return Redirect::to('customer/login')->withErrors( $loginValidator->messages() )->withInput();
    }

    public function getRegister()
    {
        return View::make('customer.register');
    }

    public function postRegister()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));

        $validator = Validator::make(Input::all(), User::$rules);

        if ($validator->passes()) {
            $customer = new User;
            $customer->fill(Input::all());
            $customer->password = Hash::make(Input::get('password'));
            $customer->status = User::STATUS_PENDING;
            $customer->save();

            //send email
            $data['username'] = Input::get('username');
            $recipient = Input::get('email');
            $token = Crypt::encrypt($recipient);

            $data['token'] = $token;
            Mail::send('emails.customer.register', $data, function($message) use($recipient)
            {
                $message->to($recipient)->subject('Welcome!');
            });

            return Redirect::to('customer/login')->with('message', 'Thank you for your registering.
                                    Please login to your email and activate your account.');
        } else {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }
    }

    public function getProfile()
    {
        // If logged in, redirect customer
        if (!Auth::check())
        {
            return Redirect::to( 'customer/login' );
        }
        $customer = Auth::user();
        $data['customer'] = $customer;

        return View::make('customer.profile', $data);
    }

    public function getActivate($token)
    {
        if(empty($token)){
            return Redirect::to('customer/login')->withErrors('Account activation fails. Token is empty.');
        }

        $email = Crypt::decrypt($token);
        $customer = User::firstOrNew(array('email' => $email));
        if(empty($customer->email)){
            return Redirect::to('customer/login')->withErrors('Account activation fails. Token is invalid.');
        }
        if(!empty($customer->email) && $customer->status == User::STATUS_VERIFIED){
            return Redirect::to('customer/login')->withErrors('Your account has been activated');
        }

        $customer->status = User::STATUS_VERIFIED;
        $customer->save();

        return Redirect::to('customer/login')->with('message', trans('Your account was activated!'));
    }
}