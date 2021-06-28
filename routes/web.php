<?php

use Illuminate\Support\Facades\Route;

Route::name('guest')->group(function() {
    Route::namespace('Guests')->group(function() {
        Route::get('/{section?}', 'PageController@getSections')->name('.lvl1.sections');
    });
});

