<?php
// role
Route::prefix('appointment-request')->name('appointment-request.')->group(function(){
	Route::get('/index','AppointmentManage@index')->name('index');
	Route::get('/acceptedList','AppointmentManage@acceptedList')->name('acceptedList');
	Route::get('/rejectedList','AppointmentManage@rejectedList')->name('rejectedList');
	Route::get('/index/{date}','AppointmentManage@index')->name('dateindex');
	Route::get('/acceptedList/{date}','AppointmentManage@acceptedList')->name('dateacceptedList');
	Route::get('/rejectedList/{date}','AppointmentManage@rejectedList')->name('daterejectedList');
	
	Route::get('/create','AppointmentManage@create')->name('create');
	// Route::get('/sorting','AppointmentManage@sorting')->name('sorting');
	// Route::get('/add','AppointmentManage@add')->name('add');
	Route::get('/approved/{id}','AppointmentManage@approved')->name('approved');
	Route::get('/declined/{id}','AppointmentManage@declined')->name('declined');
 	Route::post('/store','AppointmentManage@store')->name('store');
	Route::get('{editData}/edit','AppointmentManage@edit')->name('edit');
	Route::get('/get_mp_list','AppointmentManage@get_mp_list')->name('get_mp_list');
	Route::get('/get_ministry_list','AppointmentManage@get_ministry_list')->name('get_ministry_list');
	Route::put('/update/{editData}','AppointmentManage@update')->name('update');
	Route::post('/delete','AppointmentManage@destroy')->name('delete');
});

Route::prefix('appointment-received')->name('appointment-received.')->group(function(){
	Route::get('/index','AppointmentManage@receivedIndex')->name('index');
	Route::get('/acceptedList','AppointmentManage@receivedAcceptList')->name('acceptedList');
	Route::get('/rejectedList','AppointmentManage@receivedRejectList')->name('rejectedList');
	Route::get('/index/{date}','AppointmentManage@receivedIndex')->name('dateindex');
	Route::get('/acceptedList/{date}','AppointmentManage@receivedAcceptList')->name('dateacceptedList');
	Route::get('/rejectedList/{date}','AppointmentManage@receivedRejectList')->name('daterejectedList');
	Route::get('/create','AppointmentManage@create')->name('create');
	// Route::get('/sorting','AppointmentManage@sorting')->name('sorting');
	// Route::get('/add','AppointmentManage@add')->name('add');
	Route::get('/approved/{id}','AppointmentManage@receivedApproved')->name('approved');
	Route::get('/declined/{id}','AppointmentManage@receivedDeclined')->name('declined');
 	Route::post('/store','AppointmentManage@store')->name('store');
	Route::get('{editData}/edit','AppointmentManage@edit')->name('edit');
	Route::get('/details_data','AppointmentManage@details_data')->name('details_data');
	Route::get('/timechange_data','AppointmentManage@timechange_data')->name('timechange_data');
	Route::get('/get_ministry_list','AppointmentManage@get_ministry_list')->name('get_ministry_list');
	Route::put('/update/{editData}','AppointmentManage@update')->name('update');
	Route::put('/appointment_accept/{editData}','AppointmentManage@appointment_accept')->name('appointment_accept');
	Route::put('/appointment_update/{editData}','AppointmentManage@appointment_update')->name('appointment_update');
	Route::post('/delete','AppointmentManage@destroy')->name('delete');
});

// menu-permission
Route::prefix('menu-permission-info')->name('menu-permission-info.')->group(function(){
	Route::get('/list', 'MenuPermissionController@list')->name('list');
	Route::post('/store','MenuPermissionController@store')->name('store');
});
