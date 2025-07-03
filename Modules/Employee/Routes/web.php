<?php


Route::prefix('employee')->group(function() {
    Route::get('/', 'EmployeeController@index');
});


Route::group(['prefix' => '/manager'], function () {
    Route::middleware('manager.permision')->group(function () {

        Route::redirect('/', 'product');

        Route::group(['prefix' => 'employee'],function (){
            Route::match(['get', 'post'],'/', 'EmployeeController@index')->name('employee.index');
            Route::get('/create/', 'EmployeeController@create')->name('employee.create');
            Route::get('/edit/{id}', 'EmployeeController@edit')->name('employee.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'EmployeeController@store')->name('employee.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'EmployeeController@update')->name('employee.update');
            Route::get('/destroy/{id}', 'EmployeeController@destroy')->name('employee.destroy');
            Route::get('/print/{id}', 'EmployeeController@print')->name('employee.print');
            Route::get('/table', 'EmployeeController@show')->name('employee.show');
            Route::post('/send-notification', 'EmployeeController@sendNotification')->name('send.notification');
            Route::get('/notification', 'EmployeeController@notification')->name('employee.notification');

            Route::get('/detail/{id}', 'EmployeeController@detail')->name('employee.detail');


            Route::match(['get', 'post'] , '/report/{id}', 'EmployeeController@report')->name('employee.report');
//            Route::match(['get', 'post'] , '/employe-person/{id}/{person}', 'EmployeeController@report_employe')->name('project.report_employe');

        });



        Route::prefix('employee_file')->group(function() {
            Route::get('/list/{id}', 'EmployeeFileController@index')->name('employee_file.index');
            Route::get('/table', 'EmployeeFileController@show')->name('employee_file.show');
            Route::get('/create/{id}', 'EmployeeFileController@create')->name('employee_file.create');
            Route::get('/edit/{id}', 'EmployeeFileController@edit')->name('employee_file.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'EmployeeFileController@store')->name('employee_file.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'EmployeeFileController@update')->name('employee_file.update');
            Route::get('/destroy/{id}', 'EmployeeFileController@destroy')->name('employee_file.destroy');
        });

        Route::prefix('employee_leave')->group(function() {
            Route::get('/list/{id}', 'EmployeeLeaveController@index')->name('employee_leave.index');
            Route::get('/table', 'EmployeeLeaveController@show')->name('employee_leave.show');
            Route::get('/create/{id}', 'EmployeeLeaveController@create')->name('employee_leave.create');
            Route::get('/edit/{id}', 'EmployeeLeaveController@edit')->name('employee_leave.edit');
            Route::match(['get', 'post'] , '/store/{id?}', 'EmployeeLeaveController@store')->name('employee_leave.store');
            Route::match(['get', 'post'] , '/update/{id?}', 'EmployeeLeaveController@update')->name('employee_leave.update');
            Route::get('/destroy/{id}', 'EmployeeLeaveController@destroy')->name('employee_leave.destroy');
        });

    });
});
