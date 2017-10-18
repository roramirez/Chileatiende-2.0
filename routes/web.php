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
Route::resource('/instituciones', 'InstitutionController');
Route::get('/que-es-chileatiende', 'AboutController');
Route::get('/terminos-y-condiciones', 'TermsController');
Route::get('/politica-de-privacidad', 'PrivacyPolicyController');
Route::get('/ayuda/sucursales', 'FaqController@getOffices');
Route::get('/ayuda/{content?}', 'FaqController');

Route::group(['middleware' => ['auth'], 'prefix'=>'backend', 'namespace'=>'Backend'],function () {
    Route::get('/', 'HomeController@getIndex');
    Route::resource('/oficinas', 'OfficeController');
    Route::resource('/fichas', 'PageController');
    Route::put('/fichas/{id}/master', 'PageController@updateMaster');
    Route::get('/fichas/{pageId}/versions', 'PageController@versions');
    Route::get('/fichas/{pageId}/versions/{versionId}/publish', 'PageController@publishVersion');

    Route::group(['prefix'=>'api','namespace'=>'API'], function (){
        Route::resource('files', 'FileController');
        Route::resource('institutions', 'InstitutionController');
        Route::resource('categories', 'CategoryController');
        Route::resource('locations', 'LocationController');
    });
});

