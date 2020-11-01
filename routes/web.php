<?php

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
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
    // Master Barang
    Route::match(['get', 'post'], '/home/master/barang', 'MasterController@masterbarangIndex');


});


