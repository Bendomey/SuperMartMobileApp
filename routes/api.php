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
Route::post('resend_validation_code','CustomerAuthenticationController@resendValidationCode')->name('resend_validation_code');
Route::post('login','CustomerAuthenticationController@login')->name('login');

/**
* Password reset flow routes
*/

Route::post('forgot_password','CustomerAuthenticationController@forgotPassword')->name('forgot_password');
Route::post('validate_code','CustomerAuthenticationController@validateCode')->name('validate_code');
Route::post('reset_password','CustomerAuthenticationController@resetPassword')->name('reset_password');
Route::post('resend_verification_code','CustomerAuthenticationController@resendVerifyCode')->name('resend_verification_code');

/**
* 1.Update the Full Name
* 2.Update the email
* 3.Update the contact
* 4.Update the password
*/

Route::post('update_profile','CustomerAuthenticationController@updateProfile')->name('update_profile');
Route::post('update_password','CustomerAuthenticationController@updatePassword')->name('update_password');


/**
* Get data from the database
*/

Route::group([], function(){
	Route::get('homepage','MobileAppController@homepage')->name('homepage');
	Route::get('single_product/{id}','MobileAppController@product');
	Route::get('featured_stores','MobileAppController@all_featured_stores');
	Route::get('single_store/{id}','MobileAppController@single_store');
	// Route::get('get_categories','MobileAppController@categories')->name('get_categories');
	Route::get('get_products/{name}','MobileAppController@products');
	Route::get('featured_single_store/{id}','MobileAppController@featured_single_store');
	Route::get('promote_products','MobileAppController@promote_products');
	Route::get('promote_products_all', 'MobileAppController@promote_products_all');
	//searching ajax
	Route::get('/search_product/{data}','MobileAppController@search');
});

/**
* Working with the orders
*/

Route::group([],function(){
	Route::post('make_order','MobileAppController@makeOrder')->name('make_order');
});