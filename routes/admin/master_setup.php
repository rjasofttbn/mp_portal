<?php
	Route::resource('/ministries','MinistryController');
	Route::resource('/ministry_wings','MinistryWingController');

    Route::resource('/constituencies','ConstituencyController');

    Route::resource('/departments','DepartmentController');

    Route::resource('/designations','DesignationController');

    Route::resource('/parliaments','ParliamentController');

    Route::resource('/parliament_sessions','ParliamentSessionController');

    Route::resource('/political_parties','PoliticalPartiesController');

    Route::resource('/divisions','DivisionController');

    Route::resource('/districts','DistrictController');

    Route::resource('/upazilas','UpazilaController');
    Route::resource('/songshodBlock','SongshodBlockController');
    Route::resource('/songshodFloor','SongshodFloorController');
    Route::resource('/songshodRoom','SongshodRoomController');

    Route::get('/cabinets','CabinetController@index');
    Route::get('/cabinet/{ministry_id}/{type}','CabinetController@setup_cabinet');
    Route::post('/cabinet/save','CabinetController@save');