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

Route::group(['middleware' => [ 'auth:api' ]],function (){
    Route::match(array('GET','POST'),'/api/v1/auth/logout', 'Auth\UserController@logout')->name('api_v1_logout_call');
});
Route::get('/api/v1/food/order', 'OrderController@order')->name('food/order');
Route::get('/api/v1/food/order-to-chef', 'OrderController@orderToChef')->name('food/orderToChef');
Route::get('/api/v1/food/close-order', 'OrderController@closeOrder')->name('food/closeOrder');

Route::delete('/api/v1/food/order-delete-waiter', 'OrderController@orderDeleteWaiter')->name('food/orderDeleteWaiter');

Route::get('/api/v1/food/order-waiter-list', 'OrderController@orderWaiterList')->name('food/orderWaiterList');
Route::get('/api/v1/food/order-chef-list', 'OrderController@orderChefList')->name('food/orderChefList');
Route::get('/api/v1/food/order-closed-list', 'OrderController@orderClosedList')->name('food/orderClosedList');
Route::get('/api/v1/food/order-history-list', 'OrderController@orderHistoryList')->name('food/orderHistoryList');
