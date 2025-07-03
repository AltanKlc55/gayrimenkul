<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Middleware;

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

Route::group(['prefix' => '/manager' , 'namespace' => 'App\Http\Controllers'], function () {
    Route::redirect('/', 'manager/dashboard');
    Route::group(['manage' => 'App\Http\Controllers\Middleware'],function (){
        Route::redirect('/', 'manager/dashboard');
    });
});


Route::get('/filemanager', 'App\Http\Controllers\FileManagerController@index')->name('filemanager');
Route::post('/statusupdate', 'App\Http\Controllers\AjaxController@update');