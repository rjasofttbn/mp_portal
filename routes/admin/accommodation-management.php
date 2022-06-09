<?php



Route::prefix('setup')->name('setup.')->namespace('Setup')->group(function(){



     /*
Author: Naziur Rahman
route list start

 */
     Route::get('/areas/duplicate-check','AreaController@duplicateDataCheck')->name('areas.duplicate-check');
     Route::get('/accommodationbuildings/duplicate-check','AccommodationBuildingController@duplicateDataCheck')->name('accommodationbuildings.duplicate-check');
     Route::get('/housebuildings/duplicate-check','HouseBuildingController@duplicateDataCheck')->name('housebuildings.duplicate-check');
     Route::get('/flat_types/duplicate-check','FlatTypeController@duplicateDataCheck')->name('flat_types.duplicate-check');


    Route::resource('areas','AreaController');
    Route::resource('accommodationbuildings','AccommodationBuildingController');
    Route::resource('housebuildings','HouseBuildingController');
    Route::resource('flat_types', 'FlatTypeController');
    Route::resource('floorflats','FloorFlatController');

    //flat list route start
    Route::get('/flats','FlatController@index')->name('flats.index');
    Route::get('/flats/type/create','FlatController@create')->name('flats.type-setup');
    Route::post('/flats/type/store','FlatController@store')->name('flats.type-store');
    Route::get('/flats/{id}/edit','FlatController@edit')->name('flats.edit');
    Route::put('/flats/type/update/{id}','FlatController@update')->name('flats.type-update');
    Route::delete('/flats/{id}','FlatController@destroy')->name('flats.destroy');
    //flat list route end
    Route::resource('application_types','AccommodationApplicationTypeController');

      /*
Author: Naziur Rahman
route list end

 */

 

    Route::resource('hostel_buildings','HostelBuildingController');
    Route::resource('hostel_floors','HostelFloorController');
    
    Route::resource('office_rooms','OfficeRoomController');
    Route::resource('office_room_types','OfficeRoomTypeController');
    Route::resource('office','OfficeController');
    // Hostel
    Route::resource('hostel_application_types', 'HostelApplicationTypeController');



});