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

// Route::get('/', function () {
//     return view('welcome');
// });


//for administrator
Route::group(['middleware'=>'auth'], function(){
	Route::get('/','ViewController@index')->name('/');
	Route::get('/profile','ViewController@profile')->name('profile');
	Route::post('/update_profile_phase_1','ProfileController@updatePersonalInfo')->name('update_profile_phase_1');
	Route::post('/update_password_phase_1','ProfileController@updatePassword')->name('updatePassword');
	Route::post('/update_profile_img','ProfileController@update_profile_img')->name('update_profile_img');
});

Auth::routes();
Route::get('logout','Auth\LoginController@logout')->name('logout');
Route::get('/home', 'HomeController@index')->name('home');
