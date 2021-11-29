<?php

use Illuminate\Support\Facades\Route;

Route::middleware('authorized')->group(function () {
    Route::name('cms')->group(function () {
        Route::namespace('CMS')->group(function () {
            Route::post('/cms/menu', 'CmsController@handleMenuRequest');
            Route::post('/cms/errors', 'ErrorController@handleRequest')->name('.error.handle');
            Route::post('/cms/uploads', 'CmsController@uploadFiles')->where('section', '[a-z_]*')->name('.upload');
            Route::post('/cms/{section}', 'CmsController@handleSectionRequest')->where('section', '[a-z_]*')->name('.section.request');
            Route::get('/cms/icons', 'ImageLoaderController@loadIcon');
            Route::get('/cms/{section}', 'CmsController@handleSection')->where('section', '[a-z_]*')->name('.lvl1.sections');
            Route::get('/cms', 'CmsController@handle')->name('.root');
        });
    });
});

Route::name('guest')->group(function() {
    Route::namespace('Auth')->group(function() {
        Route::post('/authconf', 'AuthController@authConfirm')->name('.auth.request.confirm');
        Route::post('/auth', 'AuthController@listenRequest')->name('.auth.request.listen');
        Route::get('/auth', 'AuthController@checkAuthCode')->name('.auth.check.code');
        Route::get('/logout', 'AuthController@logoff')->name('.logout');
    });

    Route::namespace('Guests')->group(function() {
        Route::post('/asio/{section?}', 'PageAsyncController@handleRequest')->where('section', '[a-z_]*')->name('.async.sections');
        Route::get('/{section?}', 'PageController@getSections')->where('section', '[a-z_]*')->name('.lvl1.sections');
    });
});

