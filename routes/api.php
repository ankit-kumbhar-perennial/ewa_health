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

Route::post('users', 'API\UserController@store');
Route::apiResource('users', 'API\UserController');
Route::post('user/forgetPassword', 'API\UserController@forgetPassword');
Route::post('user/verifyOTP', "API\UserController@verifyOTP");
Route::post('user/resetPassword', 'API\UserController@resetPassword');

Route::apiResource('facilities', 'API\FacilitiesController');

Route::apiResource('appointments', 'API\AppointmentController');

Route::apiResource('history', 'API\AppointmentController');

Route::apiResource('update_status', 'API\StatusController');


Route::group(['prefix' => 'user'], function () {
    Route::post('signin', 'PassportController@login');
    Route::post('signup', 'PassportController@signup');
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('signout', 'PassportController@signout');
        Route::post('updateDeviceToken', 'PassportController@updateDeviceToken');
//        Route::get('user', 'AuthController@user');
    });
});