<?php

Route::get('/', '\\Jason\\Chat\\Controllers\\ChatController@getIndex');

Route::get('chat/check-have-slot/{gender}', '\\Jason\\Chat\\Controllers\\ChatController@checkSlotAvailableForOppositeGender');

Route::controller('chat', '\\Jason\\Chat\\Controllers\\ChatController');

