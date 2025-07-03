<?php
use Illuminate\Support\Facades\Route;

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
    Route::match(['get', 'post'], '/auth', 'AuthController@index')->name('auth');

    Route::middleware('manager.permision')->group(function () {

    Route::get('/logout', 'AuthController@logout')->name('logout');

    Route::redirect('/', 'admin');

  
        Route::group(['prefix' => 'admin'],function (){
        Route::match(['get', 'post'],'/', 'AdminController@index')->name('admin.index');
        Route::get('/create', 'AdminController@create')->name('admin.create');
        Route::get('/edit/{id}', 'AdminController@edit')->name('admin.edit');
        Route::match(['get', 'post'] , '/store/{id?}', 'AdminController@store')->name('admin.store');
        Route::match(['get', 'post'] , '/update/{id?}', 'AdminController@update')->name('admin.update');
        Route::get('/destroy/{id}', 'AdminController@destroy')->name('admin.destroy');

        Route::get('/table', 'AdminController@show')->name('admin.show');
    });

    Route::group(['prefix' => 'roles'],function (){
        Route::match(['get', 'post'],'/', 'RolesController@index')->name('roles.index');
        Route::get('/create', 'RolesController@create')->name('roles.create');
        Route::get('/edit/{id}', 'RolesController@edit')->name('roles.edit');
        Route::match(['get', 'post'] , '/store/{id?}', 'RolesController@store')->name('roles.store');
        Route::match(['get', 'post'] , '/update/{id?}', 'RolesController@update')->name('roles.update');
        Route::get('/destroy/{id}', 'RolesController@destroy')->name('roles.destroy');
        Route::get('/table', 'RolesController@show')->name('roles.show');
    });

        Route::group(['prefix' => 'has-permission'],function (){
            Route::get('/{id}', 'HasPermissionController@index')->name('haspermission.index');

            Route::match(['get', 'post'] , '/store/{id?}', 'HasPermissionController@store')->name('haspermission.store');
        });

});
});