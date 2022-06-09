<?php
Route::name('master_setup.')->prefix('master-setup')->namespace('MasterSetup')->group(base_path('routes/admin/master_setup.php'));
Route::name('requisition.')->prefix('requisition')->namespace('Requisition')->group(base_path('routes/admin/requisition.php'));
Route::name('menu-management.')->prefix('menu-management')->namespace('MenuManagement')->group(base_path('routes/admin/menu_management.php'));
Route::name('user-management.')->prefix('user-management')->namespace('UserManagement')->group(base_path('routes/admin/user_management.php'));
Route::name('profile_activities.')->prefix('profile-activities')->namespace('ProfileActivities')->group(base_path('routes/admin/profile_activities.php'));
Route::name('accommodation-management.')->prefix('accommodation-management')->namespace('AccommodationManagement')->group(base_path('routes/admin/accommodation-management.php'));

Route::name('accommodation-asset-management.')->prefix('accommodation-asset-management')->namespace('AccommodationAssetManagement')->group(base_path('routes/admin/accommodation-asset-management.php'));


Route::name('petition_management.')->prefix('petition-management')->namespace('PetitionManagement')->group(base_path('routes/admin/petition_management.php'));
Route::name('appointment-management.')->prefix('appointment-management')->namespace('AppointmentManagement')->group(base_path('routes/admin/appointment_management.php'));














