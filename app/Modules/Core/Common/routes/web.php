<?php

Route::get('/core', function () {
    dd(module()->all(), plugin()->all(), Theme::all());
    //return view('welcome');
});
