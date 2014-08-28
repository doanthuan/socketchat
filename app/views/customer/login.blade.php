@extends('layouts.public')


@section('content')

<div class="wrapper body-inverse">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 class="text-center">Account Login</h2>

                    {{ Form::open(array('url' => 'user/login', 'id' => 'login-form', 'class' => 'form-white')) }}

                    <div class="form-group">
                        {{ Form::label('email', 'Email') }}
                        {{ Form::text('email', null, array('class' => 'form-control', 'required', 'placeholder' => 'Enter Email')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('password', 'Password') }}
                        {{ Form::input('password','password', null, array('class' => 'form-control required', 'placeholder' => 'Enter Password')) }}
                    </div>

                    <div class="form-group">
                        <a href="{{ url('password/remind') }}">{{trans('Forgotten Password')}}</a>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="{{trans('login')}}">
                    </div>

                    {{ Form::close(); }}

                </div>
        </div>
    </div>
</div>

@stop