<?php







Route::group(['prefix' => 'accommodation', 'as' => 'accommodation.', 'namespace' => 'Accommodation'], function () {

    Route::resource('accommodation_types', 'AccommodationTypeController');
    
    Route::resource('office_room_types','OfficeRoomTypeController');
   
    

    //accommodation department

    Route::get('applications/application/dashboard', 'AccommodationDepartmentController@dashboardInfo');
    Route::get('applications/application/application_monitoring', 'AccommodationDepartmentController@application_monitoring');
    Route::get('applications/application/application-monitoring-data', 'AccommodationDepartmentController@applicationMonitoringData');
    Route::get('applications/application/application-monitoring-data-for-whip', 'AccommodationDepartmentController@applicationMonitoringDataForWhip');
    Route::get('applications/application/application-monitoring-data-for-whip-approve', 'AccommodationDepartmentController@applicationMonitoringDataForWhipApprove');
    Route::get('applications/application/application-monitoring-data-reject', 'AccommodationDepartmentController@applicationMonitoringDataReject');


    Route::get('applications/application/application_monitoring/flat/approve_application/{id}', 'AccommodationDepartmentController@flat_approve_application');

    Route::get('applications/application/application_monitoring/flat/cancel_application/{id}', 'AccommodationDepartmentController@cancelApplicationByDepartment');

    Route::get('applications/application/whip_application_monitoring/flat/approve_application_by_whip/{id}', 'AccommodationWhipController@approve_application_by_whip');

    Route::get('applications/application/flat/cancel_application_by_whip/{id}', 'AccommodationWhipController@cancel_application_by_whip');
       


    Route::get('applications/application/application_approved', 'AccommodationDepartmentController@Whips_approval_application_list');


    Route::get('applications/application/whip_application_monitoring', 'AccommodationWhipController@whip_application_monitoring');

    Route::get('applications/application/whip_application_monitoring/flat/whip_edit_application', 'AccommodationWhipController@whip_edit_application');

    Route::get('applications/application/hostel_application_monitoring', 'HostelDepartmentController@application_monitoring');
   



    Route::get('applications/application/hostel_application_monitoring/hostel/approve_application', 'HostelDepartmentController@hostel_approve_application');



    Route::get('applications/application/hostel/cancel_application_by_department/{id}', 'HostelDepartmentController@cancel_application_by_department');

    Route::get('applications/application/whip_hostel_application_monitoring', 'HostelWhipController@whip_application_monitoring');

   
    Route::get('applications/application/hostel/cancel_application_by_whip/{id}', 'HostelDepartmentController@cancel_application_by_whip');

    Route::get('applications/application/whip_hostel_application_monitoring/hostel/approve_application_by_whip/{id}', 'AccommodationWhipController@approve_application_by_whip');



    Route::get('applications/application/whip_hostel_application_monitoring/hostel/whip_edit_application', 'HostelWhipController@whip_edit_application');


});




