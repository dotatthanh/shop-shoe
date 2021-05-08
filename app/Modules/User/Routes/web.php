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
// Route::get('/thay-doi-thong-tin', 'UserController@profile')->name('profile');
// Route::post('/thay-doi-thong-tin', 'UserController@updateProfile')->name('profile.update');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/collections/{slug}', 'HomeController@category')->name('user.category');

Route::get('/chi-tiet-san-pham/{slug}/{id}', 'HomeController@productDetail')->name('user.product-detail');

Route::get('/order', 'OrderController@order')->name('user.order');
Route::post('/checkout', 'OrderController@checkout')->name('checkout');
Route::post('add-to-cart/{id}', 'OrderController@addToCart')->name('add-to-cart');
