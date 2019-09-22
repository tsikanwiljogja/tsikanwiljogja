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

Route::get('/', function () {
    return view('welcome');
});


//get me route
Route::get('/self-test', 'TelegramBotController@getMe');

//manual get updates
Route::get('/get-updates-manual', 'TelegramBotController@getUpdates');

//test send photo manual
Route::get('/send-photo','TelegramBotController@sendPhoto');

//set webhook
Route::get('/set','TelegramBotController@setWebhook');

//unset webhook
Route::get('/unset','TelegramBotController@removeWebhook');

//get udpates with webhook
Route::post('/aaansetiawantsikanwiljogja14017brikanwiljogja/webhook', 'TelegramBotController@balasPesan');




