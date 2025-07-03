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

        Route::prefix('pos')->group(function () {

            Route::get('/pos', 'PosController@index')->name('pos.index');
            Route::get('/pos/create', 'PosController@create')->name('pos.create');
            Route::get('/pos/table', 'PosController@show')->name('pos.show');
            Route::get('/pos/edit/{id}', 'PosController@edit')->name('pos.edit');
            Route::match(['get', 'post'], '/pos/store/{id?}', 'PosController@store')->name('pos.store');
            Route::get('/pos/destroy/{id}', 'PosController@destroy')->name('pos.destroy');
            Route::match(['get', 'post'], '/pos/update/{id?}', 'PosController@update')->name('pos.update');



            Route::get('/creditcard/table', 'CreditCardController@show')->name('creditcard.show');
            Route::match(['get', 'post'], '/creditcard/{id?}', 'CreditCardController@index')->name('creditcard.index');
            Route::get('/creditcard/create/{id}', 'CreditCardController@create')->name('creditcard.create');
            Route::get('/creditcard/edit/{id}', 'CreditCardController@edit')->name('creditcard.edit');
            Route::match(['get', 'post'], '/creditcard/store/{id?}', 'CreditCardController@store')->name('creditcard.store');
            Route::match(['get', 'post'], '/creditcard/update/{id?}', 'CreditCardController@update')->name('creditcard.update');
            Route::get('/creditcard/destroy/{id}', 'CreditCardController@destroy')->name('creditcard.destroy');


            Route::get('/commission/installment/{id}', 'CreditCardCommissionController@installment')->name('commission.installment');
            Route::get('/commission/create', 'CreditCardCommissionController@create')->name('commission.create');
            Route::get('/commission/table', 'CreditCardCommissionController@show')->name('commission.show');
            Route::match(['get', 'post'], '/commission/store/{id?}', 'CreditCardCommissionController@store')->name('commission.store');
        });
    });
});