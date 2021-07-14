<?php

use Illuminate\Support\Facades\Route;

Route::name('cms')->group(function () {
    Route::namespace('CMS')->group(function () {
        Route::get('/cms', 'CmsController@handle');
    });
});

Route::name('guest')->group(function() {
    Route::namespace('Auth')->group(function() {
        Route::post('/authconf', 'AuthController@authConfirm')->name('.auth.request.confirm');
        Route::post('/auth', 'AuthController@listenRequest')->name('.auth.request.listen');
        Route::get('/logout', 'AuthController@logoff')->name('.logout');
    });

    Route::namespace('Guests')->group(function() {
        Route::get('/{section?}', 'PageController@getSections')->where('section', '[a-z_]*')->name('.lvl1.sections');
    });
});

