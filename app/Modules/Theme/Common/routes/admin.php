<?php

Route::prefix('themes')->namespace('Admin')->group(function () {
    Route::get('/', 'ThemeController@index')->name('admin.themes');
    Route::get('{theme}', 'ThemeController@edit')->name('admin.theme.edit');

    Route::post('{theme}/active', 'ThemeController@active')->name('admin.theme.active');

    Route::post('{theme}', 'ThemeController@update')->name('admin.theme.update');
});
