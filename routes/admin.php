<?php  
//Admin group
        
Route::group(["prefix" => "Admin"],function(){
	//User group
	Route::group(['prefix' => 'User'],function(){

		//get view user
		Route::get("list",'AdminController@getList')->name("manager.user.list");
    	//get profile user
		Route::get("profile",'AdminController@profile')->name("profile");
    	//get user and paginate
		Route::get("paginate",'AdminController@paginate')->name("paginate");
    	//add user
		Route::get("add",'AdminController@add')->name("admin.user.add");
		Route::post("add",'AdminController@addPost');
    	//edit user
		Route::get("edit",'AdminController@getById')->name("edit");
		Route::post("edit",'AdminController@editPost')->name("editPost");
    	//delete user
		Route::get("delete",'AdminController@delete')->name("delete");
    	//delete all user
		Route::get("deleteAll",'AdminController@deleteAll')->name("deleteAll");
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
});
?>