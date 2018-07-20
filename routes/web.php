<?php

Route::get('/', function () {
    return redirect('admin');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/{demopage?}', 'DemoController@demo')->name('demo');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
