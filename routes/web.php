<?php

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

Route::get('/', 'HomeController@index')->name('home');


Route::prefix('guestbook')->group(function () {
    Route::get('/', 'GuestbookController@index')->name('guestbook');

    Route::middleware(['auth'])->group(function () {
        Route::post('/send', 'GuestbookController@send')->name('guestbook-send');
        Route::match(['get', 'post'], '/answer/{message_id}', 'GuestbookController@answer')->name('guestbook-answer');
    });
});

Auth::routes();

