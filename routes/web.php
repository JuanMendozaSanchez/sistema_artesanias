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

Route::get('/usuarios', 'UserController@index');

Route::get('/lista_usuarios', 'UserController@mostrar_usuarios');

Route::get('/formulario_usuario', 'UserController@create');

Route::post('/agregar_nuevo_usuario', 'UserController@agregar_nuevo_usuario');

Route::get('/usuarios/{id}', 'UserController@show')
    ->where('id', '[0-9]+');

Route::get('/usuarios/nuevo', 'UserController@create');

//Route::get('/saludo/{name}/{nickname?}', 'WelcomeUserController');