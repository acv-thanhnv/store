<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Api!
|
*/
Route::match(array('GET','POST'),'/api/v1/auth/login', 'Auth\UserController@login')->name('api_v1_login_call');

Route::get('/api/v1/food/list-by-store/{storeId?}', 'FoodController@listByStore')->name('food/list-by-store');
Route::get('/api/v1/food/list-by-menu/{menuId?}', 'FoodController@listByMenu')->name('food/list-by-menu');
Route::get('/api/v1/food/list-menu-by-store/{storeId?}', 'FoodController@listMenu')->name('food/list-menu-by-store');
Route::get('/api/v1/food/list-floor-by-store', 'FoodController@listFloors')->name('food/list-floor-by-store');
Route::get('/api/v1/food/list-location-by-floor', 'FoodController@listTableByFloor')->name('food/list-location-by-floor');
Route::get('/api/v1/food/list-order-by-location', 'FoodController@getOrderByLocation')->name('food/list-order-by-location');
Route::get('/api/v1/food/get-location', 'FoodController@getLocation')->name('food/get-location');
Route::get('/api/v1/food/get-order-detail', 'FoodController@getOrderDetail')->name('food/get-order-detail');


Route::group(['middleware' => [ 'auth:api' ]],function (){
    Route::match(array('GET','POST'),'/api/v1/auth/logout', 'Auth\UserController@logout')->name('api_v1_logout_call');
});
Route::get('/api/v1/food/order', 'OrderController@order')->name('food/order');

