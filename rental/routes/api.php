<?php

Route::post('/users/create','UserController@createUser');
Route::post('/users/login','UserController@login');

Route::get('/users/{id}','UserController@getInfo')
    ->middleware('verify_jwt')
    ->middleware('get_logged_in');

Route::get("/categories", "CategoryController@getCategories");
Route::get("/regions", "RegionController@getRegions");
Route::get("/items", 'AdController@getAds');
Route::get("/items/{id}", 'AdController@getAd')
    ->middleware('get_logged_in');

Route::prefix('account')->middleware(['verify_jwt','get_logged_in'])->group(function (){
    Route::post('/items/create', 'AdController@createAd');
    Route::post("/rents/create_invoice", "RentController@createInvoice");
    Route::get("/rents/get_invoice", "RentController@getInvoice");
    Route::patch("/rents/approve", "RentController@approveRent");
    Route::get("/rents/get", "RentController@getUserRents");
    Route::get("/rents/get/{id}", "RentController@getRentInfo");
});
