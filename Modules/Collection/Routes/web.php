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
        Route::group(['prefix' => '/collection'],function (){
            Route::match(['get', 'post'],'/', 'CollectionController@index')->name('collection.index');
            Route::get('/report', 'CollectionController@report')->name('collection.report');
            Route::get('/create', 'CollectionController@create')->name('collection.create');
            Route::get('/edit/{id}', 'CollectionController@edit')->name('collection.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'CollectionController@store')->name('collection.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'CollectionController@update')->name('collection.update');
            Route::get('/destroy/{id}', 'CollectionController@destroy')->name('collection.destroy');
            Route::get('/table', 'CollectionController@show')->name('collection.show');
            Route::match(['get', 'post'] , '/child', 'CollectionController@child')->name('collection.child');

        });
    });
 });