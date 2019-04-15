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


Route::post('register','CustomerAuthenticationController@register')->name('register');
Route::post('verify_user','CustomerAuthenticationController@verifyAccount')->name('verify_user');
Route::post('login','CustomerAuthenticationController@login')->name('login');

/**
* Password reset flow routes
*/

Route::post('forgot_password','CustomerAuthenticationController@forgotPassword')->name('forgot_password');
Route::post('validate_code','CustomerAuthenticationController@validateCode')->name('validate_code');
Route::post('reset_password','CustomerAuthenticationController@resetPassword')->name('reset_password');