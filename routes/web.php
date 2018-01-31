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

//Redirects de ChileAtiende viejo
use App\Page;

Route::get('/fichas/ver/{pageId}', function($pageId){
    $page = Page::find($pageId);
    if(!$page)
        abort(404);
    return redirect('/fichas/'.$page->guid, 301);
});
Route::get('/oficinas', function(){
    return redirect('/ayuda/sucursales', 301);
});
Route::get('/contenidos/en-linea', function(){
    return redirect('/ayuda/atencion-telefonica', 301);
});
Route::get('/contenidos/callcenter', function(){
    return redirect('/ayuda/atencion-telefonica', 301);
});
Route::get('/serviciosdisponibles', function(){
    return redirect('/instituciones', 301);
});
Route::get('/servicios/ver/{institutionId}', function($institutionId){
    return redirect('/instituciones/'.$institutionId, 301);
});
Route::get('/contenidos/preguntas-frecuentes', function(){
    return redirect('/ayuda/preguntas-frecuentes', 301);
});


//Rutas
Route::auth();

if (!App::environment('local')) URL::forceScheme('https');

Route::get('login/claveunica', 'Auth\LoginController@redirectToProvider');
Route::get('login/claveunica/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/', 'HomeController@getIndex');
Route::get('/buscar', 'SearchController@getIndex');
Route::get('/fichas/destacadas', 'PageController@featured');
Route::resource('/fichas', 'PageController');
Route::resource('/instituciones', 'InstitutionController');
Route::get('/mi-chileatiende', 'MiChileAtiendeController@getIndex');
Route::get('/que-es-chileatiende', 'ContentController');
Route::get('/terminos-y-condiciones', 'ContentController');
Route::get('/politica-de-privacidad', 'ContentController');
Route::get('/enlaces-transparencia', 'TransparencyController');
Route::get('/ayuda/sucursales', 'FaqController@getOffices');
Route::get('/ayuda/oficinas-moviles', 'FaqController@getMobileOffices');
Route::get('/ayuda/preguntas-frecuentes', 'ContentController');
Route::get('/ayuda/atencion-telefonica', 'ContentController');
Route::get('/ayuda/{content?}', 'FaqController');
Route::get('/desarrolladores/access_token', 'DeveloperController@createAccessToken');
Route::post('/desarrolladores/access_token', 'DeveloperController@storeAccessToken');
Route::get('/desarrolladores/{section?}/{subSection?}', 'DeveloperController');

Route::group(['middleware' => ['frontend']], function () {
    Route::get('/perfil', 'ProfileController@edit');
    Route::put('/perfil', 'ProfileController@update');
    Route::resource('/notificaciones', 'NotificationController');
});


Route::group(['middleware' => ['backend'], 'prefix' => 'backend', 'namespace' => 'Backend'], function () {
    Route::get('/', 'HomeController@getIndex');
    Route::get('/perfil', 'ProfileController@edit');
    Route::put('/perfil', 'ProfileController@update');
    Route::resource('/ministerios', 'MinistryController');
    Route::resource('/instituciones', 'InstitutionController');
    Route::resource('/usuarios', 'UserController');
    Route::resource('/oficinas', 'OfficeController');
    Route::resource('/categorias', 'CategoryController');
    Route::resource('/notificaciones', 'NotificationController');
    Route::put('/fichas/featured', 'PageController@updateFeatured');
    Route::get('/fichas/featured', 'PageController@featured');
    Route::resource('/fichas', 'PageController');
    Route::put('/fichas/{id}/status', 'PageController@updateStatus');
    Route::put('/fichas/{id}/master', 'PageController@updateMaster');
    Route::get('/fichas/{pageId}/versions', 'PageController@versions');
    Route::get('/fichas/{pageId}/versions/{versionId}/publish', 'PageController@publishVersion');
    Route::get('/fichas/{pageId}/history', 'PageController@history');
    Route::resource('/contenidos', 'ContentController');

    Route::group(['prefix' => 'api', 'namespace' => 'API'], function () {
        Route::resource('files', 'FileController');
        Route::resource('institutions', 'InstitutionController');
        Route::resource('ministries', 'MinistryController');
        Route::resource('categories', 'CategoryController');
        Route::resource('locations', 'LocationController');
        Route::resource('pages', 'PageController');
        Route::get('analytics/realtime', 'AnalyticsController@getRealtime');
        Route::get('analytics/ga', 'AnalyticsController@getGA');
    });
});
