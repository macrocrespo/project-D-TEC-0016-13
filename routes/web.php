<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

$admin_url = Config::get('backend.admin_url');

/* --------------------------- FRONT-END --------------------------- */

Route::get('/', 'Frontend\InicioController@index')->name('fe.inicio');

/* --------------------------- BACK-END --------------------------- */

// Autenticación
Auth::routes();

// Panel de control
Route::prefix($admin_url)->group(function () {

    // Panel de control
    Route::get('', 'Backend\InicioController@index')->name('inicio');

    // Usuarios
    $url = 'usuarios'; $c = 'Backend\UsuariosController';
    $f = 'list';    Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    $f = 'delete';  Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    $f = 'verify';  Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    Route::resource($url, $c);

    // Roles
    $url = 'roles'; $c = 'Backend\RolesController';
    $f = 'list';    Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    $f = 'delete';  Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    $f = 'verify';  Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    $f = 'permiso'; Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    Route::resource($url, $c);

    // Notas
    $url = 'notas'; $c = 'Backend\NotasController';
    $f = 'list';    Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    $f = 'delete';  Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    $f = 'verify';  Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    Route::resource($url, $c);

    // Tipos de notas
    $url = 'tipo_notas'; $c = 'Backend\Tipo_notasController';
    $f = 'list';    Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    $f = 'delete';  Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    $f = 'verify';  Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    Route::resource($url, $c);

    // Informes comunes
    $url = 'informes_comunes'; $c = 'Backend\Informes_comunesController';
    $f = 'list';            Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    $f = 'delete';          Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    $f = 'verify';          Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    $f = 'images_add';      Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    $f = 'images_list';     Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    $f = 'images_delete';   Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    Route::resource($url, $c);

    // Informes avances
    $url = 'informes_avances'; $c = 'Backend\Informes_avancesController';
    $f = 'list';            Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    $f = 'delete';          Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    $f = 'verify';          Route::post($url.'/'.$f, $c.'@'.$f)->name($url.'.'.$f);
    Route::resource($url, $c);

});

/* RESOURCE ROUTES

Verb          Path                        Action  Route Name
GET           /users                      index   users.index
GET           /users/create               create  users.create
POST          /users                      store   users.store
GET           /users/{user}               show    users.show
GET           /users/{user}/edit          edit    users.edit
PUT|PATCH     /users/{user}               update  users.update
DELETE        /users/{user}               destroy users.destroy

*/