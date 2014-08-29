<?php

Route::get('/', 'HomeController@index');

Route::post('/booking', 'HomeController@booking');