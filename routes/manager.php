<?php
//=========order-manager==================
Route::get('order_manager/{idStore?}', 'OrderManagerController@index');
Route::get('menulist/{idStore?}', 'OrderManagerController@getMenuListByStoreId');
?>