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

Route::prefix('finance')->group(function() {
    Route::get('/', 'FinanceController@index');
});


Route::group(['prefix' => '/CenterPanel'], function () {
    Route::middleware('Permision')->group(function () {
        Route::group(['prefix' => 'center/gelir-gider'],function (){
            Route::match(['get', 'post'],'/', 'FinanceController@index')->name('finance.index');
            Route::get('/report', 'FinanceController@report')->name('finance.report');
            Route::get('/create', 'FinanceController@create')->name('finance.create');
            Route::get('/edit/{id}', 'FinanceController@edit')->name('finance.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'FinanceController@store')->name('finance.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'FinanceController@update')->name('finance.update');
            Route::get('/destroy/{id}', 'FinanceController@destroy')->name('finance.destroy');
            Route::get('/table', 'FinanceController@show')->name('finance.show');
        });


        Route::group(['prefix' => 'center/gelir-gider-grup'],function (){
            Route::match(['get', 'post'],'/', 'FinanceGroupController@index')->name('finance_group.index');
            Route::get('/create', 'FinanceGroupController@create')->name('finance_group.create');
            Route::get('/edit/{id}', 'FinanceGroupController@edit')->name('finance_group.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'FinanceGroupController@store')->name('finance_group.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'FinanceGroupController@update')->name('finance_group.update');
            Route::get('/destroy/{id}', 'FinanceGroupController@destroy')->name('finance_group.destroy');
            Route::get('/table', 'FinanceGroupController@show')->name('finance_group.show');
        });


        Route::group(['prefix' => 'center/gelir-gider-grup-alt'],function (){
            Route::match(['get', 'post'],'/{id}', 'FinanceGroupChildController@index')->where('id', '[0-9]+')->name('finance_group_child.index');
            Route::get('/create/{id}', 'FinanceGroupChildController@create')->name('finance_group_child.create');
            Route::get('/edit/{id}', 'FinanceGroupChildController@edit')->name('finance_group_child.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'FinanceGroupChildController@store')->name('finance_group_child.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'FinanceGroupChildController@update')->name('finance_group_child.update');
            Route::get('/destroy/{id}', 'FinanceGroupChildController@destroy')->name('finance_group_child.destroy');
            Route::get('/table/{id}', 'FinanceGroupChildController@show')->name('finance_group_child.show');
        });
    });
});