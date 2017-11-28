<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/suggest', 'API\SuggestController@getIndex');
Route::resource('/categories', 'API\CategoryController');

//API Antigua
Route::resource('/fichas', 'API\PageController');
Route::get('/servicios/{institutionId}/fichas', 'API\PageController@indexByInstitution');
Route::resource('/servicios', 'API\InstitutionController');