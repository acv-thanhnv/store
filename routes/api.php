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
Route::group(['prefix' => 'api/v1', 'name' => 'api_v1.'], function () {
	Route::get('/store/{storeId}/customer2cashier.json', 'CashierController@showInvoicesPushedByCustomer');
	Route::get('/store/{storeId}/cashier.json', 'CashierController@showInvoicesByStore');
	Route::get('/store/{storeId}/order/{orderId}/cashier_detail.json', 'CashierController@showInvoiceDetails');
	Route::get('/store/{storeId}/chef.json', 'KitchenController@showFoodByStore');
	Route::get('/store/{storeId}/chef/order.json', 'KitchenController@listOrder');
	Route::get('/store/{storeId}/chef/{orderId}.json', 'KitchenController@showFoodByOrder');
	Route::get('/store/{storeId}/order/{orderId}.json', 'KitchenController@listFoodByOrder');
	Route::get('/store/{storeId}/chef_queue.json', 'KitchenController@showFoodQueue');
	Route::get('/store/{storeId}/chef_location.json', 'KitchenController@showOrderLocationByStore');
	Route::get('/store/{storeId}/chef_order_detail.json', 'KitchenController@showOrderDetail');
	Route::get('/store/{storeId}/order/{orderId}/test.json', 'KitchenController@showPriorityByOrder');
	Route::get('/{storeId}/{orderId}/test', 'KitchenController@test');
});

Route::match(array('GET','POST'),'/api/v1/auth/login', 'Auth\UserController@login')->name('api_v1_login_call');

Route::get('/api/v1/food/list-by-store/{storeId?}', 'FoodController@listByStore')->name('food/list-by-store');

Route::get('/api/v1/food/list-by-menu/{menuId?}', 'FoodController@listByMenu')->name('food/list-by-menu');

Route::get('/api/v1/food/list-menu-by-store/{storeId?}', 'FoodController@listMenu')->name('food/list-menu-by-store');

Route::get('/api/v1/food/list-floor-by-store', 'FoodController@listFloors')->name('food/list-floor-by-store');

Route::get('/api/v1/food/list-order-by-location', 'FoodController@getOrderByLocation')->name('food/list-order-by-location');

Route::get('/api/v1/food/get-location', 'FoodController@getLocation')->name('food/get-location');

Route::get('/api/v1/food/get-order-detail', 'FoodController@getOrderDetail')->name('food/get-order-detail');
//new order
Route::get('newOrder', 'FoodController@newOrder')->name('newOrder');

//send order to chef
Route::post('Order2Chef', 'FoodController@Order2Chef')->name('Order2Chef');

//search table/menu
Route::get('order/search', 'FoodController@search')->name('OrderSearch');

//delete food order detail
Route::get('deleteFoodOrderDetail', 'FoodController@deleteFoodOrderDetail')->name('deleteFoodOrderDetail');

//delete order
Route::get('deleteOrder', 'FoodController@deleteOrder')->name('deleteOrder');

Route::group(['middleware' => [ 'auth:api' ]],function (){
	Route::match(array('GET','POST'),'/api/v1/auth/logout', 'Auth\UserController@logout')->name('api_v1_logout_call');
});
Route::get('/api/v1/food/order', 'OrderController@order')->name('food/order');