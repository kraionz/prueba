<?php

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

Route::get('/', function () {

    //$plugin = Plugin::get('Demo');
    //$plugin->set(['name' => 'Demo']);
    //$plugin->save();
    // dd( $plugin);

    //$theme = theme('admin');
    //$theme->set(['name' => 'Admin']);
    //$theme->save();
    //dd($theme);

    $module =  Module::all();//
    $theme =  theme()->all();
    $settings = setting()->all();
    $plugins = plugin()->all();
    //dd($module,$settings, $plugins, $theme);


    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
