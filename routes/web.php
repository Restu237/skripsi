<?php

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Master Panel
    Route::get('/home/master', 'MasterController@index' );
    Route::get('/home/transaksi', 'TransaksiController@index');
    Route::get('/home/laporan', 'LaporanController@index');

    // master
    Route::match(['get', 'post'], '/user', 'MasterController@index');
    // Master User
    Route::match(['get', 'post'], '/home/master/user', 'MasterController@masterUser');
    Route::put('/home/master/user/{id}', 'MasterController@updateUser');
    Route::get('/user/delete/{id}', 'MasterController@delete');
    // Master Customer
    Route::match(['get', 'post'],'/home/master/customers', 'MasterController@masterCustomers');
    Route::put('/home/master/customers/{kd_kstmr}', 'MasterController@updateCustomers');
    Route::get('/home/master/customers/delete/{kd_kstmr}', 'MasterController@delCustomers');
    Route::get('/customers/{kd_kstmr}', 'SalesOrderController@customerInfo');
    // Master Barang
    Route::match(['get', 'post'], '/home/master/barang', 'MasterController@masterbarangIndex');
    Route::put('/home/master/barang/{kd_barang}', 'MasterController@updateBarang');
    Route::get('/home/master/barang/delete/{kd_barang}', 'MasterController@deleteBarang');
    Route::get('/barang/{kd_barang}', 'SalesOrderController@barangInfo');

    // End Master panel

    // Transaksi Panel
    // transaksi so
    Route::match(['get', 'post'], '/home/transaksi/so', 'SalesOrderController@index');
    Route::post('so/create', 'SalesOrderController@create');
    Route::match(['get', 'put'], '/home/transaksi/so/{kd_so}', 'SalesOrderController@update');
    Route::get('/home/transaksi/so/delete/{kd_so}', 'SalesOrderController@delete');

    // transaksi do
    Route::match(['get', 'post'], '/home/transaksi/do', 'DeliveryOrderController@index');
    Route::get('/do/so-info/{kd_so}', 'DeliveryOrderController@sodata');
    Route::get('/do/so-info-tr/{kd_so}', 'DeliveryOrderController@sotrdata');
    // End Transaksi Panel
    Route::post('do/create', 'DeliveryOrderController@create');
    Route::match(['get', 'put'], '/home/transaksi/do/{kd_do}', 'DeliveryOrderController@update');
    Route::get('/home/transaksi/do/delete/{kd_do}', 'DeliveryOrderController@delete');



});


