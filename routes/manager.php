<?php
//=========order-manager==================
Route::get('order_manager/{idStore?}', 'OrderManagerController@index');
Route::get('test123', 'OrderManagerController@sendNotification');
//Route::get('menulist', 'OrderManagerController@getMenuListByStoreId')->name('menu_list');
//Route::get('entitieslist', 'OrderManagerController@getEntitiesByStoreID')->name('entities_list');
//Route::get('entities_by_menu', 'OrderManagerController@getEntitiesByMenuId')->name('entities_menu');