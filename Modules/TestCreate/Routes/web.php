<?php

Route::group(['prefix' => '/manager'], function () {
    Route::middleware('manager.permision')->group(function () {
    Route::redirect('/', 'testcreate');
    Route::group(['prefix' => 'testcreate'],function (){
        Route::get('/question-bank', 'TestCreateController@question_bank')->name('testcreate.question_bank');
        Route::get('/tests', 'TestCreateController@tests')->name('testcreate.tests');
        Route::get('/create', 'TestCreateController@create')->name('testcreate.create');
        Route::post('/store', 'TestCreateController@store')->name('testcreate.store');
        Route::match(['get', 'post'] , '/update/{id}', 'TestCreateController@edit')->name('testcreate.edit');
        Route::match(['get', 'post'] , '/edit', 'TestCreateController@update')->name('testcreate.update');
        Route::match(['get', 'post'] , '/delete/{id}', 'TestCreateController@delete')->name('testcreate.delete');
        Route::get('/destroy/{id}', 'TestCreateController@destroy')->name('testcreate.destroy');
        Route::get('/table', 'TestCreateController@show_question')->name('testcreate.show_question');
    });
    Route::group(['prefix' => 'test'],function (){
        Route::get('/test-list', 'TestController@index')->name('test.test_list');
        Route::get('/create_test', 'TestController@create_test_page')->name('test.create');
        Route::post('/get-table-data','TestController@test_question_filtered')->name('test.test_question_filtered');
        Route::post('/store', 'TestController@store')->name('test.store');
        Route::match(['get', 'post'] , '/update/{id}', 'TestController@update')->name('test.update');
        Route::match(['get', 'post'] , '/edit', 'TestController@edit')->name('test.edit');
        Route::match(['get', 'post'] , '/delete/{id}', 'TestController@delete')->name('test.delete');
        Route::get('/destroy/{id}', 'TestController@destroy')->name('test.destroy');
        Route::get('/table', 'TestController@show_question')->name('test.show_question');
    });
});
});
