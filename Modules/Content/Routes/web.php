<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => '/manager'], function () {
    Route::middleware('manager.permision')->group(function () {

        //Route::redirect('/', 'content');

        Route::group(['prefix' => 'content'],function (){
            Route::match(['get', 'post'],'/', 'ContentController@index')->name('content.index');
            Route::get('/create/{id}', 'ContentController@create')->name('content.create');
            Route::get('/edit/{id}', 'ContentController@edit')->name('content.edit');
            Route::match(['get', 'post'] , '/store/{menu_id}/{id?}', 'ContentController@store')->name('content.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'ContentController@update')->name('content.update');
            Route::get('/destroy/{id}', 'ContentController@destroy')->name('content.destroy');
            Route::get('/table', 'ContentController@show')->name('content.show');
        });
    });
});