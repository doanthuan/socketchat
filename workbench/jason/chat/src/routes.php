<?php

Route::get('/', '\\Jason\\Chat\\Controllers\\ChatController@getIndex');

Route::get('chat/check-have-slot/{gender}', '\\Jason\\Chat\\Controllers\\ChatController@checkSlotAvailableForOppositeGender');

Route::any('chat/set-step', '\\Jason\\Chat\\Controllers\\ChatController@setStep');

Route::controller('chat', '\\Jason\\Chat\\Controllers\\ChatController');

