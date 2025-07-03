<?php

Route::group(['prefix' => '/manager'], function () {
    Route::middleware('manager.permision')->group(function () {
    Route::redirect('/', 'subeler');
    Route::group(['prefix' => 'subeler'],function (){
        Route::get('/lists', 'SubelerContoller@lists')->name('subeler.lists');
        Route::get('/create', 'SubelerContoller@create')->name('subeler.create');
        Route::post('/store', 'SubelerContoller@store')->name('subeler.store');
        Route::match(['get', 'post'] , '/update/{id}', 'SubelerContoller@edit')->name('subeler.edit');
        Route::match(['get', 'post'] , '/edit', 'SubelerContoller@update')->name('subeler.update');
        Route::match(['get', 'post'] , '/delete/{id}', 'SubelerContoller@delete')->name('subeler.delete');
        Route::get('/table', 'SubelerContoller@show')->name('subeler.show');
    });
 });
});
