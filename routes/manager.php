<?php
//=========kitchen==================
Route::get('/test1995', 'KitchenController@pushFoodToCustomer');

Route::get('/store/{storeId}/kitchen', 'KitchenController@index');

Route::get('/store/{storeId}/cashier', 'CashierController@index');
	
Route::post('/kitchen/push-food-to-customer/{push?}', 'KitchenController@updateFoodByOrder');

Route::post('/kitchen/rollback-food', 'KitchenController@rollbackFoodByOrder');

Route::post('/rollback-payment', 'CashierController@rollbackPayment');

Route::post('/payment-done', 'CashierController@paymentDoneByOrder');

Route::get('/store/{storeId}/test/{orderId}', 'KitchenController@newOrder2Kitchen');

Route::get('/{storeId}/{orderId}/send', 'CashierController@test');
//=========kitchen==================

//=========order-manager==================
Route::get('order_manager/{idStore?}', 'OrderManagerController@index');
Route::get('test123', 'OrderManagerController@sendNotification');
//Route::get('menulist', 'OrderManagerController@getMenuListByStoreId')->name('menu_list');
//Route::get('entitieslist', 'OrderManagerController@getEntitiesByStoreID')->name('entities_list');
//Route::get('entities_by_menu', 'OrderManagerController@getEntitiesByMenuId')->name('entities_menu');
