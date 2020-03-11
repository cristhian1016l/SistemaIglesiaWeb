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
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'HomeController@index')->name('admin');

//Rutas Para líderes de CDP

Route::get('/informe', 'InformeController@index')->name('informe');
Route::get('/informe/listarCdp', 'InformeController@listarcdp');
Route::get('/informe/listarMiembros', 'InformeController@listarMiembros');
Route::get('/informe/listarMiembrosInforme', 'InformeController@listarMiembrosInforme');
Route::get('/informe/editarCdp', 'InformeController@editarCdp');
Route::put('/informe/editarCdp', 'InformeController@updateCdp');
Route::get('/informe/listarDetalleMiembros', 'InformeController@listarDetalleMiembros');
Route::get('/informe/listarLideres', 'InformeController@listarLideresInforme');
//Route::get('/informe/RegistrarInforme', 'InformeController@RegistrarInforme');
Route::post('/informe/registrar', 'InformeController@store');
Route::post('/informe/eliminar', 'InformeController@delete');
Route::get('/informe/listarInformes', 'InformeController@listarInformes');
Route::get('/informe/ReportesPdf', 'InformeController@informe_reporte');
Route::get('/informe/ReportesPdf/{NumInf}', 'InformeController@informe_reporte_lider');
Auth::routes();

//Rutas para líderes de red
Route::get('/cdp/listarCdp', 'CdpController@listarcdp');
Route::get('/cdp/listarMiembros', 'CdpController@listarMiembros');
Route::get('/cdp/listarDetalleMiembros', 'CdpController@listarDetalleMiembros');

Route::get('/informe/listarInformesRed', 'InformeController@listarInformesRed');

Route::get('/user','UserController@index');
Route::post('/user/registrar', 'UserController@store');
Route::put('/user/actualizar', 'UserController@update');
Route::put('/user/desactivar', 'UserController@desactivar');
Route::put('/user/activar', 'UserController@activar');
Route::get('/user/selectLider', 'UserController@selectLider');














