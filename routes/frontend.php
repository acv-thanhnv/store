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
// customer
Route::get("map","HomeController@Map"); 
Route::get("ClosestStore","HomeController@ClosestStore")->name("ClosestStore"); 
Route::get("/","HomeController@Home"); 
Route::get("Contact","HomeController@Contact"); 
//Order
Route::get("Menu","FoodOrderController@getMenu")->name("Menu"); 
Route::get("Food","FoodOrderController@getFood")->name("getFood"); 
Route::get("Order","FoodOrderController@index")->name("Order"); 
Route::get("FoodDetail","FoodOrderController@FoodDetail"); 


