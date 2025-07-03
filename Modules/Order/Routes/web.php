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

        Route::redirect('/', 'order');

        Route::group(['prefix' => 'order'],function (){
            Route::match(['get', 'post'],'/', 'OrderController@index')->name('order.index');
            Route::get('/edit/{id?}', 'OrderController@edit')->name('order.edit');
            Route::match(['get', 'post'] , '/update/{id?}', 'OrderController@update')->name('order.update');
            Route::get('/destroy/{id}', 'OrderController@destroy')->name('order.destroy');
            Route::match(['get', 'post'],'/table', 'OrderController@show')->name('order.show');
            Route::get('/edm/{id?}', 'OrderController@EdmFatura')->name('order.edm');
            Route::get('/cargo/{id?}', 'OrderController@Cargo')->name('cargo.edm');
        });
    });
});