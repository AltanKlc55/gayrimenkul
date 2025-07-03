<?php
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



Route::prefix('manager')->middleware('Permision')->group(function () {
    Route::redirect('/', 'manager/language');


    Route::prefix('language')->group(function() {

        Route::get('/', 'LanguageController@index')->name('language.index');
        Route::get('languages/{locale}', 'LanguageController@showKeys')->name('language.showKeys');

       // Route::get('{locale}', 'LanguageController@getLanguageKeys');
       // Route::put('{locale}/{key}', 'LanguageController@updateLanguageKey');

    });

});