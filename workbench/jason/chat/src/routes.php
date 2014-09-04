<?php

Route::get('/', '\\Jason\\Chat\\Controllers\\ChatController@getIndex');

Route::controller('chat', '\\Jason\\Chat\\Controllers\\ChatController');