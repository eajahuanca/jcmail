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

Auth::routes();
Route::get('/', function () {
    return redirect('/login');
});
Route::group(['middleware' => 'auth'], function(){
	Route::resource('/user', 'UserController');
	Route::get('/pnew', 'UserController@getForm');
	Route::post('/newp', 'UserController@password');
	Route::get('/home', 'HomeController@index')->name('home');
	
    Route::resource('/entrada', 'SelloEntradaController');
    Route::get('/listadoentrada', 'SelloEntradaController@listado');
    Route::get('/saldotematica/{idtematica}', 'SelloEntradaController@saldoTematica');

    Route::resource('/salida', 'SelloSalidaController');
    Route::get('/listadosalida', 'SelloSalidaController@listado');
    Route::get('/reporte/{idsalida}', 'SelloSalidaController@reporte');

    Route::resource('/reversion', 'SellosReversionController');
});
