<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/manager'], function () {
    Route::redirect('/manager', 'manager/dashboard');

    Route::get("/not-auth", function(){
        return view('not_auth');
    })->name('not_auth');
});

Route::group(['prefix' => '/manager' , 'namespace' => 'App\Http\Controllers'], function () {
    Route::get("/manager", function(){
        return redirect('manager/dashboard');
    })->name('default');
});

Route::group(['prefix' => '/'], function () {
    Route::get("/", 'App\Http\Controllers\InterfaceController@index')->name('interface.index');
    Route::get("/about", 'App\Http\Controllers\InterfaceController@about')->name('interface.about');
    Route::get("/blogs", 'App\Http\Controllers\InterfaceController@blogs')->name('interface.blogs');
    Route::get("/projects", 'App\Http\Controllers\InterfaceController@projects')->name('interface.projeler');
    Route::match(['get', 'post'], '/ilanlar', 'App\Http\Controllers\InterfaceController@ilanlar')->name('interface.ilanlar');

    Route::group(['prefix' => 'blogs'],function (){
      Route::match(['get', 'post'], '/{slug}', 'App\Http\Controllers\InterfaceController@blogdetail')->name('interface.blogdetail');
    });
    Route::group(['prefix' => 'projects'],function (){
        Route::match(['get', 'post'], '/{slug}', 'App\Http\Controllers\InterfaceController@projectsdetail')->name('interface.projectsdetail');
    });

    Route::get("/contact", 'App\Http\Controllers\InterfaceController@contact')->name('interface.contact');
});


Route::get('/filemanager', 'App\Http\Controllers\FileManagerController@index')->name('filemanager');
Route::post('/statusupdate', 'App\Http\Controllers\AjaxController@update');