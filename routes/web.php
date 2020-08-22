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
    
});


