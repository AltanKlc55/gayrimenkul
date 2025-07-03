<?php
Route::prefix('page')->group(function() {
    Route::get('/', 'PageController@index');
});

Route::group(['prefix' => '/manager'], function () {
    Route::middleware('manager.permision')->group(function () {

        Route::group(['prefix' => 'page'],function (){
            Route::match(['get', 'post'],'/', 'PageController@index')->name('page.index');
            Route::get('/create', 'PageController@create')->name('page.create');
            Route::get('/edit/{id}', 'PageController@edit')->name('page.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'PageController@store')->name('page.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'PageController@update')->name('page.update');
            Route::get('/destroy/{id}', 'PageController@destroy')->name('page.destroy');
            Route::get('/table', 'PageController@show')->name('page.show');
        });
    });
});


