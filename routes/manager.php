<?php

Route::get('/store/{storeId}/kitchen', 'KitchenController@index');

Route::get('/store/{storeId}/cashier', 'CashierController@index');
	
Route::post('/update', 'KitchenController@updateFoodByOrder');

Route::post('/rollback', 'KitchenController@rollbackFoodByOrder');

Route::post('/rollback-payment', 'CashierController@rollbackPayment');

Route::post('/payment-done', 'CashierController@paymentDoneByOrder');

Route::get('/store/{storeId}/test/{orderId}', 'KitchenController@newOrder2Kitchen');

Route::get('/{storeId}/{orderId}/send', 'CashierController@test');