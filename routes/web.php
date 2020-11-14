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

    // End Master panel

    // Transaksi Panel 
    Route::match(['get', 'post'], '/home/transaksi/so', 'SalesOrderController@index');



    // End Transaksi Panel


});


