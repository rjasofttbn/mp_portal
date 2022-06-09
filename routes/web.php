<?php



Route::get('sub-menu/demo', 'Frontend\FrontController@demo');

Route::get('/locale/{lang}', function ($lang) {
    Session::put('locale', $lang);
    return redirect()->back();
})->name('locale');

Route::get('/cache_clear', function () {
    try {
        Artisan::call('config:cache');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('cache:clear');
        dd('cache clear');
    } catch (\Exception $e) {
        dd($e);
    }
});

Route::get('/language/{language}', function ($language) {
    Session::put('language', $language);
    return redirect()->back();
})->name('language');


// Frontend
// Route::get('/','Frontend\FrontController@home')->name('home');


Route::get('sub-menu/{menu_url}', 'Frontend\FrontController@MenuUrl')->name('menu_url')->where('menu_url', '.*');
Route::get('/test', function () {
    return view('backend.master_setup.hi');
});


Route::get('/', function () {
    return redirect()->route('login');
});


//Reset Password
Route::get('reset/password', 'Backend\PasswordResetController@resetPassword')->name('reset.password');
Route::post('check/email', 'Backend\PasswordResetController@checkEmail')->name('check.email');
Route::get('check/name', 'Backend\PasswordResetController@checkName')->name('check.name');
Route::get('check/code', 'Backend\PasswordResetController@checkCode')->name('check.code');
Route::post('submit/check/code', 'Backend\PasswordResetController@submitCode')->name('submit.check.code');
Route::get('new/password', 'Backend\PasswordResetController@newPassword')->name('new.password');
Route::post('store/new/password', 'Backend\PasswordResetController@newPasswordStore')->name('store.new.password');

// Petition 
Route::resource('/petitions','Backend\PetitionManagement\PetitionController');
// Petition 
Route::resource('/citizen_appointment','Backend\AppointmentManagement\CitizenAppointment');
Route::get('/appointmentMonitoring','Backend\AppointmentManagement\CitizenAppointment@petitionsMonitoring')->name('appointmentMonitoring');
Route::get('citizen_get_mp_list','Backend\AppointmentManagement\CitizenAppointment@get_mp_list')->name('citizen_get_mp_list');
Route::get('citizen_get_ministry_list','Backend\AppointmentManagement\CitizenAppointment@get_ministry_list')->name('citizen_get_ministry_list');
Route::post('/citizenContactInfo','Backend\AppointmentManagement\CitizenAppointment@citizenContactInfo')->name('citizenContactInfo');
Route::post('/citizenAppointmentInsert','Backend\AppointmentManagement\CitizenAppointment@petitionInsert')->name('citizenAppointmentInsert');
Route::get('/citizenAppointmentSuccess','Backend\AppointmentManagement\CitizenAppointment@petitionsWelcome')->name('citizenAppointmentSuccess');



Route::get('/petition/welcome','Backend\PetitionManagement\PetitionController@petitionsWelcome')->name('petitionsWelcome');
Route::post('/petitionInsert','Backend\PetitionManagement\PetitionController@petitionInsert')->name('petitionInsert');

Route::post('/petitionsContactInfo','Backend\PetitionManagement\PetitionController@petitionsContactInfo')->name('petitionsContactInfo');
Route::get('/petition/monitoring','Backend\PetitionManagement\PetitionController@petitionsMonitoring')->name('petitionsMonitoring');
Route::get('/petitionsMonitoringGetData','Backend\PetitionManagement\PetitionController@petitionsMonitoringGetData')->name('petitionsMonitoringGetData');

Route::get('/petitionOtpView','Backend\PetitionManagement\PetitionController@petitionOtpView')->name('petitionOtpView');

Route::get('/districtByDivision', 'Backend\MasterSetup\AjaxController@districtListByDivisionId')->name('districtByDivision');
Route::get('upazilaByDistric', 'Backend\MasterSetup\AjaxController@upazilaListByDistricId')->name('upazilaByDistric');


Auth::routes();



Route::middleware(['auth'])->group(function () {

    Route::get('/home', 'Backend\HomeController@index')->name('dashboard');


    // All route (Do not enterfare with this)
    Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        /*
         * These routes need view-backend permission
         * (good if you want to allow more than one group in the backend,
         * then limit the backend features by different roles or permissions)
         *
         * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
         */
        includeRouteFiles(__DIR__ . '/Backend/');

        // Manage Attendance
        // Crated date: 01-02-2021, Created By : Rajan Bhatta.
        Route::group(['prefix' => 'attendance', 'namespace' => 'ProfileActivities'], function () {
            Route::get('/index', 'AttendanceController@index')->name('attendance.index');
            Route::get('create', 'AttendanceController@create')->name('attendance.create');
            Route::post('create', 'AttendanceController@store')->name('attendance.store');
            /* Route::get('/edit/{id}', 'AttendanceController@edit')->name('attendance.edit');
            Route::put('/edit/{id}', 'AttendanceController@update')->name('attendance.update');*/
            Route::get('/delete', 'AttendanceController@destroy')->name('attendance.delete');

            Route::get('/my-attendance', 'AttendanceController@myAttendanceList')->name('attendance.my-attendance');
            Route::get('/mp-attendance', 'AttendanceController@mpAttendance');
            Route::post('/list-attendance', 'AttendanceController@listAttendance');
            Route::post('/save-attendance', 'AttendanceController@saveAttendance');
            Route::post('/import-attendance', 'AttendanceController@importAttendance');
            Route::get('/my-attendance-search', 'AttendanceController@parliamentSessionWiseMyattendanceSearch')->name('my-attendance-search');
        });
    });






    // For Ajax Request:
    Route::get('/clauseByParliamentBillId', 'Backend\MasterSetup\AjaxController@clauseByParliamentBillId')->name('clauseByParliamentBillId');
    Route::get('/subClauseByParliamentBillId', 'Backend\MasterSetup\AjaxController@subClauseByParliamentBillId')->name('subClauseByParliamentBillId');

    // Author Rajan Bhatta: Ceated date: 24-01-2021
    // Get District List By Division Id:
    Route::get('/districtListByDivisionId', 'Backend\MasterSetup\AjaxController@districtListByDivisionId')->name('districtListByDivisionId');
    Route::get('/floorListByBuildingId', 'Backend\MasterSetup\AjaxController@floorListByBuildingId')->name('floorListByBuildingId');
    Route::get('/accommodationTypeByAssetNameId', 'Backend\MasterSetup\AjaxController@accommodationTypeByAssetNameId')->name('accommodationTypeByAssetNameId');

    Route::get('/applicationListByAccommodationDepartment', 'Backend\MasterSetup\AjaxController@applicationListByAccommodationDepartment')->name('applicationListByAccommodationDepartment');

    Route::get('/assListByAccAssTypeId', 'Backend\MasterSetup\AjaxController@assListByAccAssTypeId')->name('assListByAccAssTypeId');


       /*   Author Naziur Rahman
         Date: 4-05-2021 */

    //accommodation setup
    Route::get('/accommodationbuildingdatabyareaid', 'Backend\Accommodation\AccommodationAjaxController@accommodationBuildingDatatByAreaId')->name('accommodationbuildingdatabyareaid');
    Route::get('/floordatabyaccommodationbuildingid', 'Backend\Accommodation\AccommodationAjaxController@floorDataByAccommodationBuildingId')->name('floordatabyaccommodationbuildingid');
    Route::get('/flatdatabyaccommodationbuildingid', 'Backend\Accommodation\AccommodationAjaxController@flatDataByAccommodationBuildingId')->name('flatdatabyaccommodationbuildingid');



    //Application submit
    Route::get('/buildingListByAreaId', 'Backend\MasterSetup\AjaxController@buildingListByAreaId')->name('buildingListByAreaId');
    Route::get('/building-list-by-area', 'Backend\MasterSetup\AjaxController@buildingListByArea')->name('building-list-by-area');
    Route::get('/flatListByBuildingId', 'Backend\MasterSetup\AjaxController@flatListByBuildingId')->name('flatListByBuildingId');
  
    Route::get('/officeRoomListByFloorId', 'Backend\MasterSetup\AjaxController@officeRoomListByFloorId')->name('officeRoomListByFloorId');

    Route::get('/floorListByFlatId', 'Backend\MasterSetup\AjaxController@floorListByFlatId')->name('floorListByFlatId');

    Route::get('floorListByAccommodationBuildingId', 'Backend\MasterSetup\AjaxController@floorListByAccommodationBuildingId')->name('floorListByAccommodationBuildingId');
    //Route::get('flatListByFloorId', 'Backend\MasterSetup\AjaxController@flatListByFloorId')->name('flatListByFloorId');
    Route::get('/hostelBuildingListByAreaId', 'Backend\MasterSetup\AjaxController@hostelBuildingListByAreaId')->name('hostelBuildingListByAreaId');
    Route::get('accommodationFlatListByBuildingId', 'Backend\MasterSetup\AjaxController@accommodationFlatListByBuildingId')->name('accommodationFlatListByBuildingId');
    Route::get('accommodation-flat-list-by-building', 'Backend\MasterSetup\AjaxController@accommodationFlatListByBuilding')->name('accommodation-flat-list-by-building');
    Route::get('confirmApplicationByAccommodationDepartment', 'Backend\MasterSetup\AjaxController@confirmApplicationByAccommodationDepartment')->name('confirmApplicationByAccommodationDepartment');
    Route::get('confirmUpdatedApplicationByWhip', 'Backend\MasterSetup\AjaxController@confirmUpdatedApplicationByWhip')->name('confirmUpdatedApplicationByWhip');
    Route::get('accommodationApplicationListForWhip', 'Backend\MasterSetup\AjaxController@accommodationApplicationListForWhip')->name('accommodationApplicationListForWhip');
    Route::get('hostelApplicationList', 'Backend\MasterSetup\AjaxController@hostelApplicationList')->name('hostelApplicationList');
    Route::get('hostelApplicationListForWhip', 'Backend\MasterSetup\AjaxController@hostelApplicationListForWhip')->name('hostelApplicationListForWhip');

    Route::get('hostelOfficeRoomListByHostelBuildingId', 'Backend\MasterSetup\AjaxController@hostelOfficeRoomListByHostelBuildingId')->name('hostelOfficeRoomListByHostelBuildingId');
    Route::get('confirmApplicationByHostelDepartment', 'Backend\MasterSetup\AjaxController@confirmApplicationByHostelDepartment')->name('confirmApplicationByHostelDepartment');

    Route::get('confirmUpdatedHostelApplicationByWhip', 'Backend\MasterSetup\AjaxController@confirmUpdatedHostelApplicationByWhip')->name('confirmUpdatedHostelApplicationByWhip');


    

    // Author Rajan Bhatta: Ceated date: 24-01-2021
    // Get Upazila List By District Id:
    Route::get('upazilaListByDistricId', 'Backend\MasterSetup\AjaxController@upazilaListByDistricId')->name('upazilaListByDistricId');

    // Author Sumon-php: Ceated date: 02-02-2021
    // Get constituencies List By District Id:
    Route::get('/constituenciesListByDistrictId', 'Backend\MasterSetup\AjaxController@constituenciesListByDistrictId')->name('constituenciesListByDistrictId');

    // Author M. Atoar Rahman: Ceated date: 23-01-2021
    // Get Floor List By Building Id:
    Route::get('residentilaFlatListByBuildingId', 'Backend\MasterSetup\AjaxController@residentilaFlatListByBuildingId')->name('residentilaFlatListByBuildingId');
    Route::get('residentilaFlatByBuildingId', 'Backend\MasterSetup\AjaxController@residentilaFlatByBuildingId')->name('residentilaFlatByBuildingId');
    Route::get('constituencyListByDistricId', 'Backend\MasterSetup\AjaxController@constituencyListByDistricId')->name('constituencyListByDistricId');

    // Author: Rajan Bhatta. Ceated date: 27-01-2021
    // Get Floor List By Hostel Building Id:
    Route::get('floorListByHostelBuildingID', 'Backend\MasterSetup\AjaxController@floorListByHostelBuildingID')->name('floorListByHostelBuildingID');

    // Author Rajan Bhatta: Ceated date: 01-02-2021
    // Get Session List By parliament Id:
    Route::get('sessionListByParliamentId', 'Backend\MasterSetup\AjaxController@sessionListByParliamentId')->name('sessionListByParliamentId');

    // Author Rajan Bhatta: Ceated date: 02-02-2021
    // Parliament session date by session ID:
    Route::get('sessionDateBySessionId', 'Backend\MasterSetup\AjaxController@sessionDateBySessionId')->name('sessionDateBySessionId');





    // Route::group(['middleware' => ['permission']], function () {


        Route::post('/data/statuschange', 'Backend\DefaultController@statusChange')->name('table.status.change');
        Route::post('/data/delete', 'Backend\DefaultController@delete')->name('table.data.delete');
        Route::get('/sub/menu', 'Backend\DefaultController@SubMenu')->name('table.data.submenu');

    //     Route::prefix('user')->group(function(){
    //         Route::get('/role','Backend\Menu\RoleController@index')->name('user.role');
    //         Route::post('/role/store','Backend\Menu\RoleController@storeRole')->name('user.role.store');
    //         Route::get('/role/edit','Backend\Menu\RoleController@getRole')->name('user.role.edit');
    //         Route::post('/role/update/{id}','Backend\Menu\RoleController@updateRole')->name('user.role.update');
    //         Route::post('/role/delete','Backend\Menu\RoleController@deleteRole')->name('user.role.delete');

    //         Route::get('/permission','Backend\Menu\MenuPermissionController@index')->name('user.permission');
    //         Route::post('/permission/store','Backend\Menu\MenuPermissionController@storePermission')->name('user.permission.store');
    //     });

        Route::prefix('profile-management')->group(function () {

            //Change Password
            Route::get('change/password', 'Backend\PasswordChangeController@changePassword')->name('profile-management.change.password');
            Route::post('store/password', 'Backend\PasswordChangeController@storePassword')->name('profile-management.store.password');
        });

    //     Route::prefix('site-setting')->group(function () {

    //         //test page
    //         Route::get('test/page', 'Backend\PasswordChangeController@changePassword')->name('site-setting.test.page');
    //     });


    //     Route::prefix('frontend-menu')->group(function () {
    //         //Post
    //         Route::get('/post/view', 'Backend\Post\PostController@view')->name('frontend-menu.post.view');
    //         Route::get('/post/add', 'Backend\Post\PostController@add')->name('frontend-menu.post.add');
    //         Route::post('/post/store', 'Backend\Post\PostController@store')->name('frontend-menu.post.store');
    //         Route::get('/post/edit/{id}', 'Backend\Post\PostController@edit')->name('frontend-menu.post.edit');
    //         Route::post('/post/update/{id}', 'Backend\Post\PostController@update')->name('frontend-menu.post.update');
    //         Route::get('/post/delete', 'Backend\Post\PostController@destroy')->name('frontend-menu.post.destroy');
    //         //Frontend Menu
    //         Route::get('/menu/view', 'Backend\Post\FrontendMenuController@view')->name('frontend-menu.menu.view');
    //         Route::get('/menu/add', 'Backend\Post\FrontendMenuController@add')->name('frontend-menu.menu.add');
    //         Route::post('/menu/single/store', 'Backend\Post\FrontendMenuController@singleStore')->name('frontend-menu.menu.single.store');
    //         Route::post('/menu/store', 'Backend\Post\FrontendMenuController@store')->name('frontend-menu.menu.store');
    //         Route::get('/menu/edit/{id}', 'Backend\Post\FrontendMenuController@edit')->name('frontend-menu.menu.edit');
    //         Route::post('/menu/update/{id}', 'Backend\Post\FrontendMenuController@update')->name('frontend-menu.menu.update');
    //         Route::get('/menu/delete', 'Backend\Post\FrontendMenuController@destroy')->name('frontend-menu.menu.destroy');
    //     });
    // });
});
