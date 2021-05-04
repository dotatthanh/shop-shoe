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

// login and register
Route::get('/dang-ky', 'UserController@register')->name('register');
Route::post('/dang-ky', 'UserController@postRegister')->name('submit-register');
Route::get('/dang-nhap', 'UserController@login')->name('login');
Route::post('/dang-nhap', 'UserController@postLogin')->name('submit-login');
Route::get('/dang-xuat', 'UserController@logout')->name('logout');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/category', 'HomeController@category')->name('user.category');
Route::get('/product-detail', 'HomeController@productDetail')->name('user.product-detail');
Route::get('/order', 'HomeController@order')->name('user.order');
