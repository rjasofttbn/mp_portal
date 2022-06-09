<?php

/**
 * All route names are prefixed with 'admin.'.
 * Start Notice Management Group
 */
Route::group(['middleware' => 'web','prefix' => 'notice-management', 'as' => 'notice_management.', 'namespace' => 'NoticeManagement'], function () {
    Route::resource('notices','NoticeController');
    Route::resource('parliament_rules','ParliamentRulesController');
    Route::resource('noticestage','NoticeStageController');
    Route::get('circulars','CircularsController@index');
    Route::post('circulars_list','CircularsController@listCircular');
    Route::get('notices/index/{status}','NoticeController@index');
    Route::get('notices/notice/priority','NoticeController@notice_priority');
    Route::get('notices/notice/notify-ministry/{type?}','NoticeController@notify_ministry');
    Route::get('notices/notice/recent-discussion/{type?}','NoticeController@recent_discussion');
    Route::get('notices/notice/generate_pdf/{department?}/{type?}','NoticeController@create_pdf');
    Route::get('notices/notice/report','NoticeController@getReport');
    Route::post('notices/notice/report','NoticeController@generateReport');
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
/**
 * All route names are prefixed with 'admin.'.
 * Start Master Setup Group
 */
Route::group(['prefix' => 'master-setup', 'as' => 'master_setup.', 'namespace' => 'MasterSetup'], function () {
    Route::resource('standing_committees','StandingCommitteeController');
    Route::resource('assessment_committees','AssessmentCommitteeController');

    Route::resource('orderofdays','OrderOfDaysController');
    Route::post('orderofdays/list_orders','OrderOfDaysController@listOrders');
    Route::post('orderofdays/order_action','OrderOfDaysController@store');
});

Route::group(['prefix' => 'profile-activities', 'as' => 'profile_activities.', 'namespace' => 'ProfileActivities'], function () {
    // Route::resource('mpbooks','MpBookController');
    Route::resource('appointments','AppointmentController');
    Route::get('appointments/approved/{id}', 'AppointmentController@approved');
    Route::get('appointments/declined/{id}', 'AppointmentController@declined');
});
