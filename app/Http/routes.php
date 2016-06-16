<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PagesController@home');
Route::get('/hotel/busqueda', 'HotelsController@busqueda');
Route::get('/hotel/{id}', 'HotelsController@hotel');
Route::get('usuario/registro', 'Auth\AuthController@getRegister');
Route::post('usuario/registro', 'Auth\AuthController@postRegister');
Route::get('usuario/logout', 'Auth\AuthController@getLogout');
Route::post('usuario/login', 'Auth\AuthController@postLogin');
Route::post('reservacion/habitacion/{id}', [
    'middleware' => 'auth',
    'uses' => 'ReservationController@reservacion'
]);
Route::post('reservacion/confirmar', [
    'middleware' => 'auth',
    'uses' => 'ReservationController@confirmar'
]);
