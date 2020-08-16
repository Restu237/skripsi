<?php

Route::get('/', function () {
    return view('login.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
