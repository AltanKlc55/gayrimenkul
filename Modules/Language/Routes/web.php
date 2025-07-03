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
    Route::redirect('/', 'dashboard');

    Route::prefix('language')->group(function() {
        Route::get('/', 'LanguageController@index')->name('language.index');
        Route::get('/table', 'LanguageController@show')->name('language.show');

        Route::get('/create', 'LanguageController@create')->name('language.create');
        Route::get('/edit/{id}', 'LanguageController@edit')->name('language.edit');
        Route::match(['get', 'post'] , '/store/{id?}', 'LanguageController@store')->name('language.store');
        Route::match(['get', 'post'] , '/update/{id?}', 'LanguageController@update')->name('language.update');
        Route::get('/destroy/{id}', 'LanguageController@destroy')->name('language.destroy');

        Route::get('/edit-words/{id}', 'LanguageController@edit_words')->name('language.edit_words');
        Route::match(['get', 'post'] , '/update-words/{id?}', 'LanguageController@update_words')->name('language.words.update');
        Route::match(['get', 'post'] , '/make-default/{id?}', 'LanguageController@make_default')->name('language.make_default');
        Route::match(['get', 'post'] , '/add-new-string/{id?}', 'LanguageController@add_new_string')->name('language.add.new.string');


    });
});
});