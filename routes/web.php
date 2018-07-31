<?php

Route::get('/', function () {
    return redirect('admin');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/users', 'UserController@index');
    Route::post('/admin/users', 'UserController@store');
    Route::get('/admin/users/add', 'UserController@add');
    Route::get('/admin/users/{userId}/edit', 'UserController@edit');
    Route::put('/admin/users/{userId}', 'UserController@update');
    Route::delete('/admin/users/{userId}', 'UserController@destroy');


    Route::get('/admin/{demopage?}', 'DemoController@demo')->name('demo');
});