<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login','ApiController@login');
Route::post('get_schedule_today','ApiController@get_schedule_today');
Route::post('get_schedule','ApiController@get_schedule');

Route::post('notification','ApiController@notification');

Route::post('cancel_schedule','ApiController@cancle_schedule');

Route::post('update_firebase_token','ApiController@update_firebase_token');

