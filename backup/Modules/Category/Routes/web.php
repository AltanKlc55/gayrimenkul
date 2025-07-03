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

Route::prefix('manager')->middleware('Permision')->group(function () {
    Route::redirect('/', 'manager/dashboard');

    Route::group(['prefix' => 'category'],function (){
        Route::match(['get', 'post'],'/', 'CategoryController@index')->name('category.index');
        Route::get('/create', 'CategoryController@create')->name('category.create');
        Route::get('/edit/{id}', 'CategoryController@edit')->name('category.edit');
        Route::match(['get', 'post'] , '/store/{id?}', 'CategoryController@store')->name('category.store');
        Route::match(['get', 'post'] , '/update/{id?}', 'CategoryController@update')->name('category.update');
        Route::get('/destroy/{id}', 'CategoryController@destroy')->name('category.destroy');
        Route::get('/table', 'CategoryController@show')->name('category.show');
    });

});