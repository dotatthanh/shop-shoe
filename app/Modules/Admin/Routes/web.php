<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/login', 'AdminController@login')->name('login');
    Route::post('/login', 'AdminController@signIn')->name('signIn');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/logout', 'AdminController@logout')->name('logout');
        // Dashboard
        Route::get('/', 'DashboardController@index')->name('dashboard');

        Route::group(['prefix' => 'product'], function () {
            Route::get('/', 'ProductController@index')->name('product.index');
            Route::get('/create', 'ProductController@create')->name('product.create');
            Route::get('/store', 'ProductController@store')->name('product.store');
        });
    });
});
