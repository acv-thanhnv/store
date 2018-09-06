<?php

/*
|--------------------------------------------------------------------------
| Acl Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/**
 * Acl module
 */
    Route::get('/acl', 'AclController@index')->name('acl_index');

    Route::post('/acl/updateAclActive', 'AclController@updateAclActive')->name('acl_updateAclActive');
    Route::post('/acl/updateAclActiveAll', 'AclController@updateAclActiveAll')->name('acl_updateAclActiveAll');
