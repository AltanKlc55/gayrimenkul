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

        Route::redirect('/', 'product');

        Route::group(['prefix' => 'product'],function (){
            Route::match(['get', 'post'],'/', 'ProductController@index')->name('product.index');
            Route::get('/create/', 'ProductController@create')->name('product.create');
            Route::get('/edit/{id}', 'ProductController@edit')->name('product.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'ProductController@store')->name('product.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'ProductController@update')->name('product.update');
            Route::get('/destroy/{id}', 'ProductController@destroy')->name('product.destroy');
            Route::get('/table', 'ProductController@show')->name('product.show');
            Route::match(['get', 'post'] , '/get-price', 'ProductController@get_price')->name('product.get_price');
        });
        Route::group(['prefix' => 'productset'],function (){
            Route::match(['get', 'post'],'/', 'ProductSetController@index')->name('productset.index');
            Route::get('/create/{id}', 'ProductSetController@create')->name('productset.create');
            Route::get('/edit/{id}', 'ProductSetController@edit')->name('productset.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'ProductSetController@store')->name('productset.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'ProductSetController@update')->name('productset.update');
            Route::get('/destroy/{id}', 'ProductSetController@destroy')->name('productset.destroy');
            Route::match(['get', 'post'] , '/table/{id?}', 'ProductSetController@show')->name('productset.show');



            Route::get('/create-child/{id}', 'ProductSetController@create_child')->name('productset.create_child');
            Route::get('/edit-child/{id}', 'ProductSetController@edit_child')->name('productset.edit_child');
            Route::match(['get', 'post'] , '/store_child/{id?}', 'ProductSetController@store_child')->name('productset.store_child');
            Route::match(['get', 'post'] , '/update_child/{id?}', 'ProductSetController@update_child')->name('productset.update_child');
            Route::get('/destroy-child/{id}', 'ProductSetController@destroy_child')->name('productset.destroy_child');

            Route::match(['get', 'post'] , '/table-child/{id?}', 'ProductSetController@show_child')->name('productset.show_child');
        });



        Route::group(['prefix' => 'product-buyying'],function (){
            Route::match(['get', 'post'],'/', 'BuyyingController@index')->name('productbuyying.index');
            Route::get('/create/{id}', 'BuyyingController@create')->name('productbuyying.create');
            Route::get('/edit/{id}', 'BuyyingController@edit')->name('productbuyying.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'BuyyingController@store')->name('productbuyying.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'BuyyingController@update')->name('productbuyying.update');
            Route::get('/destroy/{id}', 'BuyyingController@destroy')->name('productbuyying.destroy');
            Route::match(['get', 'post'] , '/table/{id?}', 'BuyyingController@show')->name('productbuyying.show');

            Route::get('/create-child/{id}', 'BuyyingController@create_child')->name('productbuyying.create_child');
            Route::get('/edit-child/{id}', 'BuyyingController@edit_child')->name('productbuyying.edit_child');
            Route::match(['get', 'post'] , '/store_child/{id?}', 'BuyyingController@store_child')->name('productbuyying.store_child');
            Route::match(['get', 'post'] , '/update_child/{id?}', 'BuyyingController@update_child')->name('productbuyying.update_child');
            Route::get('/destroy-child/{id}', 'BuyyingController@destroy_child')->name('productbuyying.destroy_child');
            Route::match(['get', 'post'] , '/table-child/{id?}', 'BuyyingController@show_child')->name('productbuyying.show_child');
        });

        Route::group(['prefix' => 'createlink'],function (){
            Route::match(['get', 'post'],'/', 'CreatelinkController@index')->name('createlink.index');
            Route::get('/create', 'CreatelinkController@create')->name('createlink.create');
            Route::get('/edit/{id}', 'CreatelinkController@edit')->name('createlink.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'CreatelinkController@store')->name('createlink.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'CreatelinkController@update')->name('createlink.update');
            Route::get('/destroy/{id}', 'CreatelinkController@destroy')->name('createlink.destroy');
            Route::get('/table', 'CreatelinkController@show')->name('createlink.show');
        });

        Route::group(['prefix' => 'productgroup'],function (){
            Route::match(['get', 'post'],'/', 'ProductGroupController@index')->name('productgroup.index');
            Route::get('/create', 'ProductGroupController@create')->name('productgroup.create');
            Route::get('/edit/{id}', 'ProductGroupController@edit')->name('productgroup.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'ProductGroupController@store')->name('productgroup.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'ProductGroupController@update')->name('productgroup.update');
            Route::get('/destroy/{id}', 'ProductGroupController@destroy')->name('productgroup.destroy');
            Route::get('/table', 'ProductGroupController@show')->name('productgroup.show');
        });
    });
});