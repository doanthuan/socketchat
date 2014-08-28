<?php

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/
Route::get('/', 'PublicController@index');
Route::get('/booking', 'PublicController@booking');
Route::get('/faqs', 'PublicController@faqs');
Route::get('/locations', 'PublicController@locations');
Route::get('/pricing', 'PublicController@pricing');
Route::get('/contact-us', 'PublicController@contactUs');
Route::get('/privacy-policy', 'PublicController@privacyPolicy');
Route::get('/terms', 'PublicController@terms');

/*
|--------------------------------------------------------------------------
| Customer
|--------------------------------------------------------------------------
*/
Route::controller('customer', 'CustomerController');
Route::controller('password', 'RemindersController');

/*
|--------------------------------------------------------------------------
| Job
|--------------------------------------------------------------------------
*/
Route::controller('job', 'JobController');