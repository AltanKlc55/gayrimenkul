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

Route::prefix('offer')->group(function() {
    Route::get('/', 'OfferController@index');
});


Route::group(['prefix' => '/manager'], function () {
    Route::middleware('manager.permision')->group(function () {

        Route::redirect('/', 'product');

        Route::group(['prefix' => 'offer'],function (){
            Route::match(['get', 'post'],'/', 'OfferController@index')->name('offer.index');
            Route::match(['get', 'post'],'/get-address', 'OfferController@get_address')->name('offer.get_address');
            Route::match(['get', 'post'],'/get-person', 'OfferController@get_person')->name('offer.get_person');
            Route::get('/create/{current_id?}', 'OfferController@create')->name('offer.create');
            Route::get('/edit/{id}', 'OfferController@edit')->name('offer.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'OfferController@store')->name('offer.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'OfferController@update')->name('offer.update');
            Route::match(['get', 'post'] , '/get-product', 'OfferController@get_product')->name('offer.get_product');
            Route::match(['get', 'post'] , '/get-product-unit', 'OfferController@get_product_unit')->name('offer.get_product_unit');
            Route::get('/destroy/{id}', 'OfferController@destroy')->name('offer.destroy');
            Route::get('/print/{id}', 'OfferController@print')->name('offer.print');
            Route::get('/table', 'OfferController@show')->name('offer.show');
        });
    });
});
