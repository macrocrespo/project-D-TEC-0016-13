<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

// Panel de control
Route::get('/inicio', 'InicioController@index')->name('inicio');
Route::get('/demo', 'InicioController@demo')->name('demo');

/*
Route::prefix('admin')->group(function () {
});
*/

// Usuarios
$url = 'usuarios'; $controller = 'UsuariosController';
Route::post($url.'/list', $controller.'@list')->name($url.'.list');
Route::post($url.'/delete', $controller.'@delete')->name($url.'.delete');
Route::post($url.'/verify', $controller.'@verify')->name($url.'.verify');
Route::resource($url, $controller);
