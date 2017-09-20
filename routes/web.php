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

Route::auth();

Route::get('/', 'HomeController@getIndex');
Route::get('/buscar', 'SearchController@getIndex');
Route::resource('/fichas', 'PageController');

Route::middleware(['auth'])->group(function () {
    Route::get('/backend', 'Backend\HomeController@getIndex');
});