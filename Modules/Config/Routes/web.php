<?php


use Illuminate\Support\Facades\Route;



Route::group(['prefix' => '/manager'], function () {

    Route::middleware('manager.permision')->group(function () {


        Route::group(['prefix' => 'config'],function (){
            Route::get('/', 'ConfigController@index')->name('config.index');
            Route::match(['get', 'post'] , '/store/{id?}', 'ConfigController@store')->name('config.store');
        });


        Route::group(['prefix' => 'definitions'],function (){
            Route::match(['get', 'post'],'/', 'DefinitonsController@index')->name('definitions.index');
            Route::get('/report', 'DefinitonsController@report')->name('definitions.report');
            Route::get('/create', 'DefinitonsController@create')->name('definitions.create');
            Route::get('/edit/{id}', 'DefinitonsController@edit')->name('definitions.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'DefinitonsController@store')->name('definitions.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'DefinitonsController@update')->name('definitions.update');
            Route::get('/destroy/{id}', 'DefinitonsController@destroy')->name('definitions.destroy');
            Route::get('/table', 'DefinitonsController@show')->name('definitions.show');
        });

    });
});