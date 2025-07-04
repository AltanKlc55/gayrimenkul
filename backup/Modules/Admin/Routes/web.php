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
    Route::match(['get', 'post'], '/auth', 'AuthController@index')->name('manager.auth');
    Route::middleware('Permision')->group(function () {
        Route::get('/logout', 'AuthController@logout')->name('manager.logout');

        Route::prefix('admin')->group(function() {
            Route::get('/', 'AdminController@index');
        });

    });
});