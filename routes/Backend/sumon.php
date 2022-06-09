<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::group(['prefix' => 'master-setup', 'as' => 'master_setup.', 'namespace' => 'MasterSetup'], function () {
    // Personal assistant route
    Route::resource('personal_secretaries','PersonalSecretaryController');
    // Parliament bill route
    Route::resource('parliament_bills','ParliamentBillController');
});


// Route::group(['prefix' => 'profile-activities', 'as' => 'profile_activities.', 'namespace' => 'ProfileActivities'], function () {
//     Route::resource('profiles','ProfileController');
// });