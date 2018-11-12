<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/**
 * backend module
 */
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/some', 'SomeController@index')->name('some');
    Route::get('/blog', 'BlogController@index')->name('blog');

    //Backend Controller
    Route::group(["prefix" => "backend"],function(){
        Route::get('/executeSchedule', 'TemplateController@executeSchedule')->name('backend_schedule_template');
        //Template Controller
        Route::group(["prefix" => "template"],function(){
            Route::get('', 'TemplateController@index')->name('backend_template');
            Route::get('form', 'TemplateController@form')->name('form_template');
            Route::get('components', 'TemplateController@components')->name('component_template');
            Route::get('buttons', 'TemplateController@buttons')->name('button_template');

            Route::get('upload', 'TemplateController@upload')->name('upload_template');
            Route::get('images/s3', 'TemplateController@getImageFromS3')->name('getimage_s3_template');
            Route::get('images/local', 'TemplateController@getImageFromLocal')->name('getimage_local_template');

            Route::post('doUpload', 'TemplateController@doUpload')->name('doUpload_template');
            Route::post('doUploadS3', 'TemplateController@doUploadS3')->name('doUploadS3_template');
            Route::post('doDeleteFile', 'TemplateController@doDeleteFile')->name('doDeleteFile_template');
            Route::post('doDeleteFileS3', 'TemplateController@doDeleteFileS3')->name('doDeleteFileS3_template');



            Route::get('general-element', 'TemplateController@generalElement')->name('generalElement_template');
            Route::get('icons', 'TemplateController@icons')->name('icons_template');
            Route::get('glyphicons', 'TemplateController@glyphicons')->name('glyphicons_template');
            Route::get('calendar', 'TemplateController@calendar')->name('calendar_template');
            Route::get('tables', 'TemplateController@tables')->name('table_template');
            Route::get('exports', 'TemplateController@exports')->name('export_template');

            Route::get('doExports', 'TemplateController@doExports')->name('doExports_template');
            Route::get('doExportsCommon/{type}', 'TemplateController@doExportsCommon')->name('doExportsCommon_template');

            Route::post('doImport', 'TemplateController@doImport')->name('doImport_template');
        });
        //User Controller
        Route::group(["prefix" => "user"],function(){
            //get view user
            Route::get("list",'UserController@getList')->name("backend.user.list");
            //get profile user
            Route::get("profile",'UserController@profile')->name("profile");
            //get user and paginate
            Route::get("paginate",'UserController@paginate')->name("paginate");
            //add user
            Route::get("add",'UserController@add')->name("add");
            Route::post("add",'UserController@addPost')->name("addPost");
            //edit user
            Route::get("edit",'UserController@getById')->name("edit");
            Route::post("edit",'UserController@editPost')->name("editPost");
            //delete user
            Route::get("delete",'UserController@delete')->name("delete");
            //delete all user
            Route::get("deleteAll",'UserController@deleteAll')->name("deleteAll");
            //test
            Route::get("test",function(){
                return view("backend.users.test");
            })->name("testAdd");
        });
        //Menu
        Route::group(["prefix" => "menu"],function(){
            Route::get("list","MenuController@getMenu")->name("getMenu");
            //add
            Route::get("addMenu","MenuController@getAddMenu")->name("addMenu");
            Route::post("addMenu","MenuController@postAddMenu")->name("postAddMenu");
            //Edit
            Route::get("editMenu","MenuController@getEditMenu")->name("editMenu");
            Route::post("editMenu","MenuController@postEditMenu")->name("postEditMenu");
            //Delete
            Route::get("deleteMenu","MenuController@deleteMenu")->name("deleteMenu");
            Route::get("deleteAllMenu","MenuController@deleteAllMenu")->name("deleteAllMenu");
        });
        //Group type
        Route::group(["prefix" => "Type"],function(){
            Route::get("list","TypeController@getType")->name("getType");
            //add
            Route::get("addType","TypeController@getAddType")->name("addType");
            Route::post("addType","TypeController@postAddType")->name("postAddType");
            //Edit
            Route::get("editType","TypeController@getEditType")->name("editType");
            Route::post("editType","TypeController@postEditType")->name("postEditType");
            //Delete
            Route::get("deleteType","TypeController@deleteType")->name("deleteType");
            Route::get("deleteAllType","TypeController@deleteAllType")->name("deleteAllType");
            //Delete Prop
            Route::get("deleteProp","TypeController@deleteProp")->name("deleteTypeProp");

        });
        //Group Food
        Route::group(["prefix" => "Food"],function(){
            Route::get("list","FoodController@getFood")->name("getFoodManager");
            //add
            Route::get("addFood","FoodController@getAddFood")->name("addFood");
            Route::post("addFood","FoodController@postAddFood");
            //Edit
            Route::get("editFood","FoodController@getEditFood")->name("editFood");
            Route::post("editFood","FoodController@postEditFood")->name("postEditFood");
            //Delete
            Route::get("deleteFood","FoodController@deleteFood")->name("deleteFood");
            Route::get("deleteAllFood","FoodController@deleteAllFood")->name("deleteAllFood");
             //Delete Food Prop
            Route::get("deleteFoodProp","FoodController@deleteFoodProp")->name("deleteFoodProp");
            //Other
            Route::get("Prop","FoodController@getProp")->name("getProp");
        });

        //Group Table
        Route::group(["prefix" => "Table"],function(){
            Route::get("myTable","TableController@getMyTable")->name("getTable");
            //add
            Route::get("addTable","TableController@getAddTable")->name("addTable");
            Route::post("addTable","TableController@postAddTable")->name('postAddTable');
            //Edit
            Route::get("editTable","TableController@getEditTable")->name("editTable");
            Route::post("editTable","TableController@update")->name("postEditTable");
            //get table price
            Route::get("tablePrice","TableController@tablePrice")->name("tablePrice");
            //Delete
            Route::get("deleteTable","TableController@deleteTable")->name("deleteTable");
            Route::get("deleteAllTable","TableController@deleteAllTable")->name("deleteAllTable");
        });

        //Group Table Type
        Route::group(["prefix" => "Table"],function(){
            Route::get("myTable","TableController@getMyTable")->name("getTable");
            //add
            Route::get("addTable","TableController@getAddTable")->name("addTable");
            Route::post("addTable","TableController@postAddTable")->name('postAddTable');
            //Edit
            Route::get("editTable","TableController@getEditTable")->name("editTable");
            Route::post("editTable","TableController@update")->name("postEditTable");
            //get table price
            Route::get("tablePrice","TableController@tablePrice")->name("tablePrice");
            //Delete
            Route::get("deleteTable","TableController@deleteTable")->name("deleteTable");
            Route::get("deleteAllTable","TableController@deleteAllTable")->name("deleteAllTable");
        });


        //Group Floor
        Route::group(["prefix" => "Floor"],function(){
            Route::get("myFloor","FloorController@getMyFloor")->name("getFloor");
            //add
            Route::get("addFloor","FloorController@getAddFloor")->name("addFloor");
            Route::post("addFloor","FloorController@postAddFloor")->name("postAddFloor");;
            //Edit
            Route::get("editFloor","FloorController@getEditFloor")->name("editFloor");
            Route::post("editFloor","FloorController@update")->name("postEditFloor");
            //Delete
            Route::get("deleteFloor","FloorController@deleteFloor")->name("deleteFloor");
            Route::get("deleteAllFloor","FloorController@deleteAllFloor")->name("deleteAllFloor");
        });

        //Group Store
        Route::group(["prefix" => "Store"],function(){
            Route::get("myStore","StoreController@getStore")->name("getStore");
            //add
            Route::get("addStore","StoreController@getAddStore")->name("addStore");
            Route::post("addStore","StoreController@postAddStore");
            //Edit
            Route::get("editStore","StoreController@getEditStore")->name("editStore");
            Route::post("editStore","StoreController@postEditStore")->name("postEditStore");
            //Delete
            Route::get("deleteStore","StoreController@deleteStore")->name("deleteStore");
            Route::get("deleteAllStore","StoreController@deleteAllStore")->name("deleteAllStore");

        });

        //Group Manage Store
        Route::group(["prefix" => "StoreManager"],function(){
            Route::get("listStore","StoreManagerController@getStoreManager")->name("getListStore");
            //add
            Route::get("addStore","StoreManagerController@addStoreManager")->name("addStoreManager");
            Route::post("addStore","StoreManagerController@postAddStoreManager");
            //Edit
            Route::get("editStore","StoreManagerController@getEditStoreManager")->name("editStoreManager");
            Route::post("editStore","StoreManagerController@postEditStoreManager")->name("postEditStoreManager");
            //Delete
            Route::get("deleteStore","StoreManagerController@deleteStoreManager")->name("deleteStoreManager");
            Route::get("deleteAllStore","StoreManagerController@deleteAllStoreManager")->name("deleteAllStoreManager");

        });

        //Dashboard
        Route::group(["prefix" => "dashboard"],function(){

            Route::get("","DashboardController@index")->name("dashboardIndex");
            Route::get("dashboard-waiter","DashboardController@dashboardWaiter")->name("dashboardWaiter");
            Route::get("dashboard-chef","DashboardController@dashboardChef")->name("dashboardChef");
            Route::get("dashboard-closed","DashboardController@dashboardClosedOrder")->name("dashboardClosedOrder");
            Route::get("dashboard-order-history","DashboardController@dashboardHistoryOrder")->name("dashboardHistoryOrder");
        });

        Route::get('food/order-to-chef', 'OrderController@orderToChef')->name('food/orderToChef');
        Route::get('food/close-order', 'OrderController@closeOrder')->name('food/closeOrder');


        Route::delete('food/order-delete-waiter', 'OrderController@orderDeleteWaiter')->name('food/orderDeleteWaiter');
        Route::delete('food/order-delete-chef', 'OrderController@orderDeleteChef')->name('food/orderDeleteChef');
        Route::delete('food/order-delete-closed', 'OrderController@orderDeleteClosed')->name('food/orderDeleteClosed');
        Route::delete('food/order-delete-history', 'OrderController@orderDeleteHistory')->name('food/orderDeleteHistory');

        Route::get('food/order-waiter-list', 'OrderController@orderWaiterList')->name('food/orderWaiterList');
        Route::get('food/order-chef-list', 'OrderController@orderChefList')->name('food/orderChefList');
        Route::get('food/order-closed-list', 'OrderController@orderClosedList')->name('food/orderClosedList');
        Route::get('food/order-history-list', 'OrderController@orderHistoryList')->name('food/orderHistoryList');
    });

