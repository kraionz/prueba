<?php

Route::prefix('modules')->group(function () {
    Route::get('/', 'ModuleController@index')->name('admin.themes');
    Route::get('{module}', 'ModuleController@edit')->name('admin.theme.edit');

    Route::post('{module}/active', 'ModuleController@active')->name('admin.theme.active');

    Route::post('{module}', 'ModuleController@update')->name('admin.theme.update');
});
