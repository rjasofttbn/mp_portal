<?php

Route::prefix('menu-info')->name('menu-info.')->middleware(['developer'])->group(function(){
	Route::get('/view', 'MenuController@list')->name('list');
	Route::get('/add', 'MenuController@add')->name('add');
	Route::post('/store', 'MenuController@store')->name('store');
	Route::get('/edit/{id}', 'MenuController@edit')->name('edit');
	Route::post('/update/{id}', 'MenuController@update')->name('update');
	Route::get('/get-sub-menu', 'MenuController@getSubMenu')->name('get-sub-menu');
});

Route::prefix('module-info')->name('module-info.')->group(function(){
	Route::get('/list','ModuleController@list')->name('list');
	Route::get('/sorting','ModuleController@sorting')->name('sorting');
	Route::get('/add','ModuleController@add')->name('add');
	Route::get('/duplicate-name-check','ModuleController@duplicateNameCheck')->name('duplicate-name-check');
	Route::get('/duplicate-name_bn-check','ModuleController@duplicateNameBnCheck')->name('duplicate-name_bn-check');
	Route::post('/store','ModuleController@store')->name('store');
	Route::get('/edit/{editData}','ModuleController@edit')->name('edit');
	Route::post('/update/{editData}','ModuleController@update')->name('update');
	Route::post('/delete','ModuleController@destroy')->name('delete');
});
