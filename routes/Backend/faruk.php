<?php

/**
 * Start Master Setup Group,  All route names are prefixed with 'admin.'.
 */
Route::group(['prefix' => 'accommodation', 'as' => 'accommodation.', 'namespace' => 'Accommodation'], function () {
    Route::resource('flat_types', 'FlatTypeController');
    Route::resource('applications', 'AccommodationApplicationController');
    // Route::resource('hostel_application', 'AccommodationApplicationController');

    //Log Accommodation
    Route::get('applications/application/logInformation', 'AccommodationApplicationController@logInformation')->name('applications.logInformation');
    Route::get('applications/application/logInformationDetail/{id}', 'AccommodationApplicationController@logInformationDetail')->name('applications.logInformationDetail');
    //Mp 
    Route::get('applications/application/mp/appNewList', 'AccommodationApplicationController@appNewList')->name('applications.mp.appNewList');
    Route::get('applications/application/mp/appCancelMpList', 'AccommodationApplicationController@appCancelMpList')->name('applications.mp.appCancelMpList');
    Route::get('applications/application/mp/appChangeMpList', 'AccommodationApplicationController@appChangeMpList')->name('applications.mp.appChangeMpList');
    Route::get('applications/application/mp/viewHighAppPending/{id}', 'AccommodationApplicationController@viewHighAppPending')->name('applications.mp.viewHighAppPending');
    Route::get('applications/application/mp/viewAppPending/{id}', 'AccommodationApplicationController@viewAppPending')->name('applications.mp.viewAppPending');
    Route::get('applications/application/mp/viewAppPendingCancel/{id}', 'AccommodationApplicationController@viewAppPendingCancel')->name('applications.mp.viewAppPendingCancel');
    Route::get('applications/application/mp/viewHighAppPendingCancel/{id}', 'AccommodationApplicationController@viewHighAppPendingCancel')->name('applications.mp.viewHighAppPendingCancel');
    Route::get('applications/application/mp/viewAppPendingChange/{id}', 'AccommodationApplicationController@viewAppPendingChange')->name('applications.mp.viewAppPendingChange');
    Route::get('applications/application/mp/viewhighAppPendingExchange/{id}', 'AccommodationApplicationController@viewhighAppPendingExchange')->name('applications.mp.viewhighAppPendingExchange');

    Route::get('applications/application/mp/approveAppPdf/{id}', 'AccommodationApplicationController@approveAppPdf')->name('applications.mp.approveAppPdf');
    
 

    Route::get('hostel_application/hostelCancel/createCancel/{id}', 'HostelApplicationController@createCancel')->name('hostel_application.hostelCancel.createCancel');
    Route::get('hostel_application/hostelChange/createChange/{id}', 'HostelApplicationController@createChange')->name('hostel_application.hostelExCancel.createChange');

    //Department   

    Route::get('applications/application/application_list_mp', 'AccommodationApplicationController@application_list_mp')->name('applications.application.application_list_mp');



    //Hostel
    Route::resource('hostel_application', 'HostelApplicationController');

    //Hostel MP
    Route::get('applications/hostel_application/hostel_application_list_mp', 'HostelApplicationController@hostel_application_list_mp')->name('applications.hostel_application.hostel_application_list_mp');
    Route::get('applications/hostel_application/hostel_app_list_approved', 'HostelApplicationController@hostel_app_list_approved')->name('applications.hostel_application.hostel_app_list_approved');

    Route::get('applications/hostel_application/hostelCancel/hostel_application_list_mp_cancel', 'HostelApplicationController@hostel_application_list_mp_cancel')->name('applications.hostel_application.hostelCancel.hostel_application_list_mp_cancel');
    Route::get('applications/hostel_application/hostelExchange/hostel_application_list_mp_exchange', 'HostelApplicationController@hostel_application_list_mp_exchange')->name('applications.hostel_application.hostelExchange.hostel_application_list_mp_exchange');

    //Hostel Department
    Route::get('applications/hostel_application/department/hostelAppNewPending', 'HostelApplicationController@hostelAppNewPending')->name('applications.hostel_application.department.hostelAppNewPending');
    Route::get('applications/hostel_application/department/hostelAppCancelPending', 'HostelApplicationController@hostelAppCancelPending')->name('applications.hostel_application.department.hostelAppCancelPending');
    Route::get('applications/hostel_application/department/hostelAppChangePending', 'HostelApplicationController@hostelAppChangePending')->name('applications.hostel_application.department.hostelAppChangePending');
    Route::get('applications/hostel_application/department/dptAppRejected', 'HostelApplicationController@dptAppRejected')->name('applications.hostel_application.department.dptAppRejected');

    //Hostel Whips
    Route::get('applications/hostel_application/department/wAppNewPending', 'HostelApplicationController@wAppNewPending')->name('applications.hostel_application.department.wAppNewPending');

// MP view pages
    Route::get('applications/hostel_application/pendingHostelApp/{id}', 'HostelApplicationController@pendingHostelApp')->name('applications.hostel_application.pendingHostelApp');
    // Route::get('applications/hostel_application/hostelCancel/viewHostelAppCancel/{id}', 'HostelApplicationController@viewHostelAppCancel')->name('applications.hostel_application.hostelCancel.viewHostelAppCancel');
    // Route::get('applications/hostel_application/hostelExChange/viewHostelAppChange/{id}', 'HostelApplicationController@viewHostelAppChange')->name('applications.hostel_application.hostelExChange.viewHostelAppChange');

    Route::post('applications/hostel_application/updateHostelAppPending/{id}', 'HostelApplicationController@updateHostelAppPending')->name('applications.hostel_application.update-hostel-app-pending');
    Route::get('applications/application/application_department_approved', 'AccommodationApplicationController@application_department_approved');

    Route::get('applications/hostel_application/approveHostelApp/{id}', 'HostelApplicationController@approveHostelApp')->name('applications.hostel_application.approveHostelApp');
    // Route::get('applications/hostel_application/approveHostelAppCancel/{id}', 'HostelApplicationController@approveHostelAppCancel')->name('applications.hostel_application.approveHostelAppCancel');
    // Route::get('applications/hostel_application/approveHostelAppChange/{id}', 'HostelApplicationController@approveHostelAppChange')->name('applications.hostel_application.approveHostelAppChange');
    // // Hostel
    // Route::resource('hostel_application_types', 'HostelApplicationTypeController');
});
/**
 * End Master Setup Group
 */

/**
 * Start Master Setup Group,  All route names are prefixed with 'admin.'.
 */

/**
 * End Master Setup Group
 */
