<?php
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// resource routes for news news items
Route::resource('news', 'NewsItemController');
//search route
Route::get('search', 'NewsItemController@searchIndex')->name('search.index');
Route::post('search/title', 'NewsItemController@searchByTitle')->name('search.title');
Route::post('search/date', 'NewsItemController@searchByDateRange')->name('search.date');
