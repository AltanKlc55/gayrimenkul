<?php
Route::group(['prefix' => '/manager'], function () {
    Route::middleware('manager.permision')->group(function () {
    Route::redirect('/', 'estateproperties');
    Route::group(['prefix' => 'estateproperties'],function (){
        Route::match(['get', 'post'],'/', 'EstatePropertiesController@index')->name('estateproperties.index');
        Route::get('/create', 'EstatePropertiesController@create')->name('estateproperties.create');
        Route::get('/edit/{id}', 'EstatePropertiesController@edit')->name('estateproperties.edit');
        Route::match(['get', 'post'] , '/store/{id?}', 'EstatePropertiesController@store')->name('estateproperties.store');
        Route::match(['get', 'post'] , '/update/{id?}', 'EstatePropertiesController@update')->name('estateproperties.update');
        Route::get('/destroy/{id}', 'EstatePropertiesController@destroy')->name('estateproperties.destroy');
        Route::get('/table', 'EstatePropertiesController@show')->name('estateproperties.show');
    });
});
});