<?php
use App\Http\Controllers\Middleware;
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
    Route::prefix('manager')->middleware('Permision')->group(function () {
        Route::redirect('/', 'manager/dashboard');

        Route::prefix('dashboard')->group(function() {
            Route::get('/', 'DashboardController@index')->name('manager.dashboard');
        });

    });