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
    Route::get('/frontend/home', 'HomeController@index')->name('home');
    Route::get('/company/login', 'HomeController@apilogin')->name('apiloginform');
    Route::get('/frontend/test', 'HomeController@test')->name('test');


    Route::get('/order', 'OrderController@index')->name('order');
    Route::get('/listMenu', 'OrderController@getFoodByStoreID')->name('listMenu');
    Route::get('/listMenuType', 'OrderController@getFoodByStoreID')->name('listMenuType');
    Route::get('/MapApi',function(){
    	return view("frontend.testMapApi");
    });


