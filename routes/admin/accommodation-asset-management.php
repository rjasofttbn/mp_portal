<?php


Route::prefix('setup')->name('setup.')->namespace('Setup')->group(function(){
  
    Route::resource('accommodation_assets', 'AccommodationAssetController');
    Route::resource('furniture_electronic_goods', 'FurnitureElectronicGoodController');
    
    Route::post('furniture-electronic-goods', 'FurnitureElectronicGoodController@findTotal')->name('furniture-electronic-goods.find-total');
    Route::resource('accommodation-asset-package', 'AccommodationAssetPackageController');
   

});