<?php


/**
 * Dev mode
 */
//Router config here...
Route::get('/dev', 'DevController@index')->name('index');
Route::get('/dev/test', 'DevController@test')->name('test');
Route::post('/dev/initProject', 'DevController@initProject')->name('initProject');


Route::get('/dev/translationManagement', 'TranslationController@translationManagement')->name('translationManagement');
//Delete translate 
Route::post('/dev/deleteTranslate', 'TranslationController@deleteTranslate')->name('deleteTranslate');
Route::post('/dev/updateTranslate', 'TranslationController@updateTranslate')->name('updateTranslate');
Route::post('/dev/generationLanguageFiles', 'TranslationController@generationLanguageFiles')->name('generationLanguageFiles');
Route::post('/dev/importTranslateToDB', 'TranslationController@importTranslateToDB')->name('importTranslateToDB');
Route::any('/dev/newTextTrans', 'TranslationController@newTextTrans')->name('newTextTrans');
Route::any('/dev/createNewTranslationItem', 'TranslationController@createNewTranslationItem')->name('createNewTranslationItem');
Route::get('/dev/translation', 'TranslationController@translationManagement')->name('translationManagement');


Route::get('/dev/readAclConfig', 'AclController@readAclConfig')->name('readAclConfig');
Route::get('/dev/generationAclConfigFiles', 'AclController@generationAclConfigFiles')->name('generationAclConfigFiles');
Route::post('/dev/updateAclActive', 'AclController@updateAclActive')->name('updateAclActive');
Route::post('/dev/updateAclActiveAll', 'AclController@updateAclActiveAll')->name('updateAclActiveAll');
Route::post('/dev/generationAclFile', 'AclController@generationAclFile')->name('generationAclFile');
Route::post('/dev/refreshAclDB', 'AclController@refreshAclDB')->name('refreshAclInDB');
Route::post('/dev/importScreensList', 'AclController@importScreensList')->name('importScreensList');
Route::get('/dev/acl', 'AclController@aclManangement')->name('aclManangement');
Route::get('/dev/userRole', 'AclController@userRole')->name('userRole');
Route::post('/dev/updateUserRole', 'AclController@updateUserRole')->name('updateUserRole');


Route::get('/dev/menu', 'MenuController@menu')->name('menu');
Route::post('/dev/menu/createMenu','MenuController@createMenu')->name('createMenu');
Route::post('/dev/menu/updateMenu','MenuController@updateMenu')->name('updateMenu');
Route::delete('/dev/menu/delete','MenuController@deleteMenu')->name('deleteMenu');



Route::get('/dev/testvalidate', 'DevController@testCustomValidate')->name('testCustomValidate');
Route::post('/dev/generateEntity', 'DevController@generateEntity')->name('generateEntity');
Route::get('/dev/entityManagement', 'DevController@entityManagement')->name('entityManagement');
Route::post('/dev/generateOneEntity', 'DevController@generateOneEntity')->name('generateOneEntity');
Route::get('/dev/log', 'DevController@log')->name('logManagement');
Route::get('/dev/doc', 'DevController@doc')->name('doc');
