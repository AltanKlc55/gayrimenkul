<?php


Route::prefix('expertpanel')->group(function() {
    Route::match(['get', 'post'], '/auth', 'ExpertAuthController@index')->name('expert_auth');
    Route::get('/logout', 'ExpertAuthController@logout')->name('expert.logout');
    Route::match(['get', 'post'], '/expertdashboard', 'ExpertPanelController@index')->name('expertdashboard');
});

