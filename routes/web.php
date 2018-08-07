<?php

Route::get('/', function () {
    return redirect('admin');
});

Route::get('/checkCardNumber', 'SubscriptionController@checkCardNumber');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/admin', 'HomeController@index');

    Route::get('/admin/users', 'UserController@index');
    Route::post('/admin/users', 'UserController@store');
    Route::get('/admin/users/add', 'UserController@add');
    Route::get('/admin/users/{userId}/edit', 'UserController@edit');
    Route::put('/admin/users/{userId}', 'UserController@update');
    Route::delete('/admin/users/{userId}', 'UserController@destroy');

    Route::get('/admin/subscriptions', 'SubscriptionController@index');
    Route::post('/admin/subscriptions', 'SubscriptionController@store');
    Route::get('/admin/subscriptions/add', 'SubscriptionController@add');
    Route::get('/admin/subscriptions/{subscriptionId}/edit', 'SubscriptionController@edit');
    Route::put('/admin/subscriptions/{subscriptionId}', 'SubscriptionController@update');
    Route::delete('/admin/subscriptions/{subscriptionId}', 'SubscriptionController@destroy');
    Route::get('/admin/subscriptions/user/{userId}', 'SubscriptionController@index');



    //Route::get('/admin/{demopage?}', 'DemoController@demo')->name('demo');
});