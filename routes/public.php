<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 6/27/2018
 * Time: 2:55 PM
 */
/**
 * Default router config
 * All of router here will skip ACL/Auth check
 */
Route::get('/', function () {
    return view('welcome');
});

Route::get('/vue_test', function () {
    return view('vue_test');
});
