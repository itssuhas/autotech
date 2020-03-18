<?php

Route::get('/', function () { 
    return view('welcome');
});

Route::get('/login', 'CommonController@showLogin')->name('login');
Route::post('/login', 'CommonController@doLogin');
Route::get('/dashboard', 'CommonController@dashboard');
Route::get('/logout', 'CommonController@getSignOutadmin');
Route::get('/changePassword', 'CommonController@passwordindex')->name('apassword');
Route::post('/changePassword', 'CommonController@store')->name('apassword');

Route::get('/supplier_deatils', 'CommonController@SupplierDeatils');
Route::post('/supplier_deatils', 'CommonController@supplierSubmit');
Route::get('Supplierdelete/{id}','CommonController@Supplierdelete');
Route::get('/supplierupdate/{id}', 'CommonController@getSuppliers');
Route::post('/supplierupdate', 'CommonController@SupplierUpdateSubmit');

Route::get('/inspector_deatils', 'CommonController@InspectorDeatils');
Route::post('/inspector_deatils', 'CommonController@inspectorSubmit');
Route::get('Inspectordelete/{id}','CommonController@Inspectordelete');
Route::get('/inspectorupdate/{id}', 'CommonController@getInspector');
Route::post('/inspectorupdate', 'CommonController@InspectorUpdateSubmit');

Route::get('/approver_deatils', 'CommonController@ApproverDeatils');
Route::post('/approver_deatils', 'CommonController@approverSubmit');
Route::get('Approverdelete/{id}','CommonController@Approverdelete');
Route::get('/approverupdate/{id}', 'CommonController@getApporver');
Route::post('/approverupdate', 'CommonController@ApproverUpdateSubmit');
