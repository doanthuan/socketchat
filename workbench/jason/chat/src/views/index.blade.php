@extends('chat::layouts.public')

@section('content')
<br/><br/><br/><br/><br/><br/>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <h2 class="text-center">Booking Appointment</h2>

        <div class="form-white">
            @include('chat::layouts.partials.message')

            {{ Form::open(array('url' => 'customer/login', 'id' => 'login-form')) }}

            <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, array('class' => 'form-control', 'required', 'placeholder' => 'Enter Your Name')) }}
            </div>

            <div class="form-group">
                {{ Form::label('gender', 'Gender') }}
                <select class="form-control" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>

            {{ Form::close(); }}
        </div>

    </div>
</div>

@stop