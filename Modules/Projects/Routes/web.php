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

Route::prefix('project')->group(function() {
    Route::get('/', 'ProjectsController@index');
});


Route::group(['prefix' => '/manager'], function () {
    Route::middleware('manager.permision')->group(function () {

        Route::redirect('/', 'product');

        Route::group(['prefix' => 'project'],function (){
            Route::match(['get', 'post'],'/', 'ProjectsController@index')->name('project.index');
            Route::match(['get', 'post'],'/finished', 'ProjectsController@finished')->name('project.finished');
            Route::get('/create/{id?}', 'ProjectsController@create')->name('project.create');
            Route::get('/edit/{id}', 'ProjectsController@edit')->name('project.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'ProjectsController@store')->name('project.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'ProjectsController@update')->name('project.update');
            Route::get('/destroy/{id}', 'ProjectsController@destroy')->name('project.destroy');
            Route::get('/table', 'ProjectsController@show')->name('project.show');
            Route::get('/table/finished', 'ProjectsController@show2')->name('project.show2');
        });
    });
});
