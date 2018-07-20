<?php

Route::get('/', function () {
    return redirect('admin');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/users', 'UserController@index');
    Route::get('/admin/{demopage?}', 'DemoController@demo')->name('demo');
});