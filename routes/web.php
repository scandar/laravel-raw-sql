<?php
Route::get('/', function () {
    return redirect()->route('news.index');
});
Route::get('home', function () {
    return redirect()->route('news.index');
});

Auth::routes();

// resource routes for news news items
Route::resource('news', 'NewsItemController');
//search route
Route::get('search', 'NewsItemController@searchIndex')->name('search.index');
Route::get('search/title', 'NewsItemController@searchByTitle')->name('search.title');
Route::get('search/date', 'NewsItemController@searchByDateRange')->name('search.date');
