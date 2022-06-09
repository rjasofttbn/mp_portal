<?php
	Route::resource('/telephone_pabx_rights','TelephonePabxController');
	Route::resource('/office_wise_telephone_pabx','OfficeWiseTelephonePabxController');
	Route::resource('/telephoneExpensesCashAllowance','TelephoneExpenseCashAllowanceController');
	Route::resource('/telephone_pabx_application','TelephonePabxApplicationController');
	Route::post('/getRoom','OfficeWiseTelephonePabxController@getRoom');
