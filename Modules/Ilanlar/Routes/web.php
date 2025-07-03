<?php

Route::group(['prefix' => '/manager'], function () {
    Route::middleware('manager.permision')->group(function () {
    Route::redirect('/', 'ilanlar');
    Route::group(['prefix' => 'ilanlar'],function (){
        Route::get('/lists', 'IlanlarController@lists')->name('ilanlar.lists');
        Route::get('/create', 'IlanlarController@create')->name('ilanlar.create');
        Route::post('/store', 'IlanlarController@store')->name('ilanlar.store');
        Route::match(['get', 'post'] , '/update/{id}', 'IlanlarController@update')->name('ilanlar.update');
        Route::match(['get', 'post'] , '/edit', 'IlanlarController@edit')->name('ilanlar.edit');
        Route::match(['get', 'post'] , '/delete/{id}', 'IlanlarController@destroy')->name('ilanlar.destroy');
        Route::get('/table', 'IlanlarController@show')->name('ilanlar.show');
    });
 });
});
