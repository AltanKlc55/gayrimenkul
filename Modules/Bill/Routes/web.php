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


Route::group(['prefix' => '/'], function () {
    Route::middleware('manager.permision')->group(function () {
        Route::group(['prefix' => 'bill'],function (){
            Route::match(['get', 'post'],'/', 'BillController@index')->name('bill.index');
            Route::get('/report', 'BillController@report')->name('bill.report');
            Route::get('/create', 'BillController@create')->name('bill.create');
            Route::get('/edit/{id}', 'BillController@edit')->name('bill.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'BillController@store')->name('bill.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'BillController@update')->name('bill.update');
            Route::get('/destroy/{id}', 'BillController@destroy')->name('bill.destroy');
            Route::get('/table', 'BillController@show')->name('bill.show');
        });
   });
});

        