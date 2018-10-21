<?php

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/**
 * frontend module
 */
//Route::get('/frontend/home', 'HomeController@index')->name('home');
Route::get('/company/login', 'HomeController@apilogin')->name('apiloginform');
Route::get('/frontend/test', 'HomeController@test')->name('test');

Route::get('/order/{idStore?}', 'OrderController@index')->name('order');
//Route::get('/foodorder', 'OrderController@index2');
Route::get('listlocation','OrderController@getTables')->name('listlocation');
    Route::get('/order', 'OrderController@index')->name('order');

Route::get('/foodorder/{idStore?}', 'FoodOrderController@index')->name('foodorder');
Route::get('/location','FoodOrderController@getLocations')->name('location');
Route::get('/itemdetail','FoodOrderController@getDetail')->name('itemdetail');


Route::view('/chef', 'frontend.chef3.index');


Route::get("cashier", function () {
    return view('frontend/cashier3/index');
});
Route::get("map","HomeController@Map"); 
Route::get("/","HomeController@Home"); 
Route::get("contact","HomeController@Contact"); 
Route::get("template","FoodOrderController@template"); 
Route::get("FoodDetail","FoodOrderController@FoodDetail"); 


