<?php
// role
Route::prefix('role-info')->name('role-info.')->group(function(){
	Route::get('/list','RoleController@list')->name('list');
	Route::get('/sorting','RoleController@sorting')->name('sorting');
	Route::get('/add','RoleController@add')->name('add');
	Route::get('/duplicate-name-check','RoleController@duplicateNameCheck')->name('duplicate-name-check');
	Route::get('/duplicate-name_bn-check','RoleController@duplicateNameBnCheck')->name('duplicate-name_bn-check');
	Route::post('/store','RoleController@store')->name('store');
	Route::get('/edit/{editData}','RoleController@edit')->name('edit');
	Route::post('/update/{editData}','RoleController@update')->name('update');
	Route::post('/delete','RoleController@destroy')->name('delete');
});

// menu-permission
Route::prefix('menu-permission-info')->name('menu-permission-info.')->group(function(){
	Route::get('/list', 'MenuPermissionController@list')->name('list');
	Route::post('/store','MenuPermissionController@store')->name('store');
});
