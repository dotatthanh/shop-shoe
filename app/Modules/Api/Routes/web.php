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

Route::group(['prefix' => 'api', 'as' => 'api.'], function () {
    Route::get('/medias', 'MediaController@index')->name('medias.index');
    Route::post('/medias/upload', 'MediaController@upload')->name('medias.upload');
    Route::post('/medias/delete', 'MediaController@delete')->name('medias.delete');
});

