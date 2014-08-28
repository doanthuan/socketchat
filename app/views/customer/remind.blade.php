<?php
Phaser::User();
?>

@extends('user.layouts.main')

@section('head')
@parent
{{ HTML::style('css/user.css') }}
@stop

@section('content')

{{ Form::open(array('class' => 'form-reminder', 'url' => 'password/remind', 'id' => 'remind-form'))}}

<h3>Password Reminders</h3>

<div class="form-group">
    {{ Form::label('email', 'Email Address') }}
    {{ Form::text('email', null, array('class' => 'form-control email', 'required', 'placeholder' => 'Enter Email')) }}
</div>

<div class="form-group">
    <input type="submit" class="btn btn-primary" value="Submit">
</div>

{{ Form::close() }}

<script type="text/javascript">
    $(function () {
        $('#remind-form').validate({
            rules : {
                email:{
                    email: true
                }
            }
        });
    });
</script>

@section('footer')
@parent
{{ HTML::script('js/jquery.validate.min.js') }}
@stop

@stop