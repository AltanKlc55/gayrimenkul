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

Route::prefix('invoice')->group(function() {
    Route::get('/', 'InvoiceController@index');
});



Route::group(['prefix' => '/manager'], function () {
    Route::middleware('manager.permision')->group(function () {

        Route::redirect('/', 'product');

        Route::group(['prefix' => 'invoice'],function (){
            Route::match(['get', 'post'],'/', 'InvoiceController@index')->name('invoice.index');
            Route::get('/create/', 'InvoiceController@create')->name('invoice.create');
            Route::get('/edit/{id}', 'InvoiceController@edit')->name('invoice.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'InvoiceController@store')->name('invoice.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'InvoiceController@update')->name('invoice.update');
            Route::get('/destroy/{id}', 'InvoiceController@destroy')->name('invoice.destroy');
            Route::get('/table', 'InvoiceController@show')->name('invoice.show');
        });
    });
});
