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
	//for profile
	Route::get('/profile','ViewController@profile')->name('profile');
	Route::post('/update_profile_phase_1','ProfileController@updatePersonalInfo')->name('update_profile_phase_1');
	Route::post('/update_password_phase_1','ProfileController@updatePassword')->name('updatePassword');
	Route::post('/update_profile_img','ProfileController@update_profile_img')->name('update_profile_img');

	//for categories management
	Route::get('/add_categories','ViewController@add_categories')->name('add_categories');
	Route::post('/add_categories/add_phase','CategoriesController@create')->name('add_category_phase');
	Route::get('/view_categories','CategoriesController@view_categories')->name('view_categories');
	Route::get('/view_categories/delete_phase/{categoryName}','CategoriesController@destroy');
	Route::post('/view_categories/update','CategoriesController@update')->name('update_category');

	//for product management
	Route::resource('/product','ProductController');
	Route::post('/product/update','ProductController@update')->name('updateProduct');
	Route::get('/product/delete_phase/{id}','ProductController@destroy');
	Route::get('/feature/{id}','ProductController@feature');
	Route::get('/unfeature/{id}','ProductController@unFeature');
	Route::get('/promote/{id}','ProductController@promote');
	Route::get('/unPromote/{id}','ProductController@unPromote');
	Route::get('/recommended/{id}','ProductController@recommended');
	Route::get('/unRecommended/{id}','ProductController@unRecommended');
	//for order management
	Route::get('/orders','OrderController@viewOrder')->name('view_orders');
	Route::get('/order/accept_order/{id}','OrderController@acceptOrder');
	Route::get('/order/reject_order/{id}','OrderController@rejectOrder');
});

Auth::routes();
Route::get('logout','Auth\LoginController@logout')->name('logout');
Route::get('/home', 'HomeController@index')->name('home');
