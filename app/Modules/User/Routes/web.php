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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/category', 'HomeController@category')->name('user.category');
Route::get('/product-detail', 'HomeController@productDetail')->name('user.product-detail');
Route::get('/order', 'HomeController@order')->name('user.order');
