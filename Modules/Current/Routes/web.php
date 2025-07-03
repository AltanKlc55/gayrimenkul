<?php


Route::group(['prefix' => '/manager'], function () {
    Route::middleware('manager.permision')->group(function () {
        Route::redirect('/', 'dashboard');

        Route::prefix('current')->group(function() {
            Route::get('/customer', 'CurrentController@index')->name('current.index');
            Route::get('/supplier', 'CurrentController@supplier')->name('current.supplier');
            Route::get('/caritable', 'CurrentController@show')->name('current.show');
            Route::get('/tedarikcitable', 'CurrentController@show2')->name('current.show2');
            Route::get('/create/{type}', 'CurrentController@create')->name('current.create');
            Route::get('/edit/{id}', 'CurrentController@edit')->name('current.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'CurrentController@store')->name('current.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'CurrentController@update')->name('current.update');
            Route::get('/destroy/{id}', 'CurrentController@destroy')->name('current.destroy');
            Route::get('/detail/{id}', 'CurrentController@detail')->name('current.detail');
        });

        Route::prefix('current_type')->group(function() {
            Route::get('/', 'CurrentTypeController@index')->name('current_type.index');
            Route::get('/table', 'CurrentTypeController@show')->name('current_type.show');
            Route::get('/create', 'CurrentTypeController@create')->name('current_type.create');
            Route::get('/edit/{id}', 'CurrentTypeController@edit')->name('current_type.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'CurrentTypeController@store')->name('current_type.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'CurrentTypeController@update')->name('current_type.update');
            Route::get('/destroy/{id}', 'CurrentTypeController@destroy')->name('current_type.destroy');
        });

        Route::prefix('current_address')->group(function() {
            Route::get('/list/{id}', 'CurrentAddressController@index')->name('current_address.index');
            Route::get('/table', 'CurrentAddressController@show')->name('current_address.show');
            Route::get('/create/{id}', 'CurrentAddressController@create')->name('current_address.create');
            Route::get('/edit/{id}', 'CurrentAddressController@edit')->name('current_address.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'CurrentAddressController@store')->name('current_address.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'CurrentAddressController@update')->name('current_address.update');
            Route::get('/destroy/{id}', 'CurrentAddressController@destroy')->name('current_address.destroy');
        });

        Route::prefix('current_person')->group(function() {
            Route::get('/list/{id}', 'CurrentPersonController@index')->name('current_person.index');
            Route::get('/table', 'CurrentPersonController@show')->name('current_person.show');
            Route::get('/create/{id}', 'CurrentPersonController@create')->name('current_person.create');
            Route::get('/edit/{id}', 'CurrentPersonController@edit')->name('current_person.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'CurrentPersonController@store')->name('current_person.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'CurrentPersonController@update')->name('current_person.update');
            Route::get('/destroy/{id}', 'CurrentPersonController@destroy')->name('current_person.destroy');
        });

        Route::prefix('current_branch')->group(function() {
            Route::get('/', 'CurrentBranchController@index')->name('current_branch.index');
            Route::get('/table', 'CurrentBranchController@show')->name('current_branch.show');
            Route::get('/create', 'CurrentBranchController@create')->name('current_branch.create');
            Route::get('/edit/{id}', 'CurrentBranchController@edit')->name('current_branch.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'CurrentBranchController@store')->name('current_branch.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'CurrentBranchController@update')->name('current_branch.update');
            Route::get('/destroy/{id}', 'CurrentBranchController@destroy')->name('current_branch.destroy');
        });

        Route::prefix('current_note')->group(function() {
            Route::get('/list/{id}', 'CurrentNoteController@index')->name('current_note.index');
            Route::get('/table', 'CurrentNoteController@show')->name('current_note.show');
            Route::get('/create/{id}', 'CurrentNoteController@create')->name('current_note.create');
            Route::get('/edit/{id}', 'CurrentNoteController@edit')->name('current_note.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'CurrentNoteController@store')->name('current_note.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'CurrentNoteController@update')->name('current_note.update');
            Route::get('/destroy/{id}', 'CurrentNoteController@destroy')->name('current_note.destroy');
        });

        Route::prefix('current_sales')->group(function() {
            Route::get('/index/{id}', 'CurrentSalesController@index')->name('current_sales.index');
            Route::get('/table', 'CurrentSalesController@show')->name('current_sales.show');
            Route::get('/create/{id}', 'CurrentSalesController@create')->name('current_sales.create');
            Route::get('/edit/{id}', 'CurrentSalesController@edit')->name('current_sales.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'CurrentSalesController@store')->name('current_sales.store');
        });

        Route::prefix('current_inventory')->group(function() {
            Route::get('/index/{id}', 'CurrentInventoryController@index')->name('current_inventory.index');
            Route::get('/table', 'CurrentInventoryController@show')->name('current_inventory.show');
            Route::get('/create', 'CurrentInventoryController@create')->name('current_inventory.create');
            Route::get('/edit/{id}', 'CurrentInventoryController@edit')->name('current_inventory.edit');
        });
    });
});