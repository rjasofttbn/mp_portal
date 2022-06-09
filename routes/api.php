<?php

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

//for reve

Route::group([
    'namespace' => 'Backend\NoticeManagement'
], function ($router) {
    Route::post('push-from-prp/circular', 'CircularsController@CircularPushFromPRP');
    Route::post('get-from-mp_portal/notice', 'NoticeController@getNoticeListFromMpPortal');
});

//for nanosoft
Route::group([
	// 'middleware' => 'auth:api',
	'prefix' => 'auth',
	'namespace' => 'Api'
], function ($router) {
	Route::post('login', 'AuthController@login');
	Route::post('logout', 'AuthController@logout');
	Route::post('refresh', 'AuthController@refresh');
});

Route::group([
	'middleware' => 'auth:api',
	'prefix' => 'admin/notice-management',
	'namespace' => 'Backend\NoticeManagement'
], function ($router) {Route::resource('notices','NoticeController');
    Route::resource('parliament_rules','ParliamentRulesController');
    Route::resource('noticestage','NoticeStageController');
    Route::get('circulars','CircularsController@index');
    Route::post('circulars_list','CircularsController@listCircular');
    Route::get('notices/index/{status}','NoticeController@index');
    Route::get('notices/notice/priority','NoticeController@notice_priority');
    Route::get('notices/notice/notify-ministry/{type?}','NoticeController@notify_ministry');
    Route::get('notices/notice/recent-discussion/{type?}','NoticeController@recent_discussion');
    Route::get('notices/notice/generate_pdf/{department?}/{type?}','NoticeController@create_pdf');
    Route::post('notices/notice/setdata','NoticeController@set_notice_data');
    Route::get('discussed','NoticeController@discussedNotices');
    Route::get('ministryitem','NoticeController@ministryWingList');
    Route::get('notices/notice/speaker','NoticeController@speaker_notice');
    Route::get('noticeList','NoticeController@allNotices');
    Route::get('filtered_notice','NoticeController@filtered_notice');
    Route::get('notice_details/{type}/{id}','NoticeController@notice_data');
    Route::post('notices/notice/makelottery','NoticeController@make_lottery');
    Route::get('notice_list/{status_id?}','NoticeController@notice_list');
    Route::post('notices/notice/notice_speech/{id?}', 'NoticeController@notice_speech');
    Route::get('notices/notice/load_speech/', 'NoticeController@load_speech');
});


Route::group([
	'middleware' => 'auth:api',
	'prefix' => 'admin/accommodation',
	'namespace' => 'Backend\Accommodation'
], function ($router) {    Route::resource('flat_types', 'FlatTypeController');
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
    Route::get('applications/hostel_application/viewHostelAppPending/{id}', 'HostelApplicationController@viewHostelAppPending')->name('applications.hostel_application.viewHostelAppPending');
    Route::get('applications/hostel_application/hostelCancel/viewHostelAppCancel/{id}', 'HostelApplicationController@viewHostelAppCancel')->name('applications.hostel_application.hostelCancel.viewHostelAppCancel');
    Route::get('applications/hostel_application/hostelExChange/viewHostelAppChange/{id}', 'HostelApplicationController@viewHostelAppChange')->name('applications.hostel_application.hostelExChange.viewHostelAppChange');

    Route::post('applications/hostel_application/updateHostelAppPending/{id}', 'HostelApplicationController@updateHostelAppPending')->name('applications.hostel_application.update-hostel-app-pending');
    Route::get('applications/application/application_department_approved', 'AccommodationApplicationController@application_department_approved');
});

Route::group([
	'middleware' => 'auth:api',
	'prefix' => 'admin/master-setup',
	'namespace' => 'Backend\MasterSetup'
], function ($router) {
    Route::resource('orderofdays','OrderOfDaysController');
    Route::post('orderofdays/list_orders','OrderOfDaysController@listOrders');
    Route::post('orderofdays/order_action','OrderOfDaysController@store');
});
Route::group([
	'middleware' => 'auth:api',
	'prefix' => 'attendance',
	'namespace' => 'Backend\ProfileActivities'
], function ($router) {
    Route::post('list_attendance','AttendanceController@listAttendance');
});