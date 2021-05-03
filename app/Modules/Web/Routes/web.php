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
Route::get('/', 'HomeController@index')->name('web.index');
Route::get('/category', 'HomeController@category')->name('web.category');
Route::get('/product-detail', 'HomeController@productDetail')->name('web.product-detail');
Route::get('/order', 'HomeController@order')->name('web.order');
