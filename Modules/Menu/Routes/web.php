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

        Route::redirect('/', 'menu');

        Route::group(['prefix' => 'menu'],function (){
            Route::match(['get', 'post'],'/', 'MenuController@index')->name('menu.index');
            Route::get('/create', 'MenuController@create')->name('menu.create');
            Route::get('/edit/{id}', 'MenuController@edit')->name('menu.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'MenuController@store')->name('menu.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'MenuController@update')->name('menu.update');
            Route::get('/destroy/{id}', 'MenuController@destroy')->name('menu.destroy');
            Route::get('/table', 'MenuController@show')->name('menu.show');
        });
    });
});