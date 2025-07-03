<?php

Route::prefix('psikologlar')->group(function() {
    Route::get('/', 'PsikologlarController@index');
});

Route::group(['prefix' => '/manager'], function () {
    Route::middleware('manager.permision')->group(function () {
        Route::group(['prefix' => 'psikologlar'],function (){
            Route::match(['get', 'post'],'/', 'PsikologlarController@index')->name('psikologlar.index');
            Route::get('/create', 'PsikologlarController@create')->name('psikologlar.create');
            Route::get('/edit/{id}', 'PsikologlarController@edit')->name('psikologlar.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'PsikologlarController@store')->name('psikologlar.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'PsikologlarController@update')->name('psikologlar.update');
            Route::get('/destroy/{id}', 'PsikologlarController@destroy')->name('psikologlar.destroy');
            Route::get('/print/{id}', 'PsikologlarController@print')->name('psikologlar.print');
            Route::get('/table', 'PsikologlarController@show')->name('psikologlar.show');
            Route::post('/send-notification', 'PsikologlarController@sendNotification')->name('send.notification');
            Route::get('/notification', 'PsikologlarController@notification')->name('psikologlar.notification');
            Route::get('/detail/{id}', 'PsikologlarController@detail')->name('psikologlar.detail');
            Route::match(['get', 'post'] , '/report/{id}', 'PsikologlarController@report')->name('psikologlar.report');
        });
    });
});
