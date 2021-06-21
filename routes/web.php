<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('guest')->group(function() {
    Route::namespace('Guests')->group(function() {
        Route::get('/{section?}', 'PageController@getSections')->name('.lvl1.sections');
    });
});

/*
Route::get('/', function () {
    return view('npc_home');
});
*/
