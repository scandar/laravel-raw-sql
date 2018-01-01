<?php
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// resource routes for news news items
Route::resource('news', 'NewsItemController');
