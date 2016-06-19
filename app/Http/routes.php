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
Route::get('/crud', 'PagesController@crud');
Route::get('/hotel/busqueda', 'HotelsController@busqueda');
Route::get('/hotel/busqueda/{id}', 'HotelsController@hotel');
Route::resource('hotel', 'HotelsController');
Route::get('usuario/registro', 'Auth\AuthController@getRegister');
Route::post('usuario/registro', 'Auth\AuthController@postRegister');
Route::get('usuario/logout', 'Auth\AuthController@getLogout');
Route::post('usuario/login', 'Auth\AuthController@postLogin');
Route::post('hotel/{idHotel}/habitacion/{idHabitacion}/reservacion', [
    'middleware' => 'auth',
    'uses' => 'ReservationController@reservacion'
]);
Route::post('reservacion/confirmar', [
    'middleware' => 'auth',
    'uses' => 'ReservationController@confirmar'
]);
Route::get('usuario/reservaciones/mostrar', [
    'middleware' => 'auth',
    'uses' => 'ReservationController@mostrar'
]);
Route::post('usuario/reservaciones/modificar', [
    'middleware' => 'auth',
    'uses' => 'ReservationController@modificar'
]);
Route::post('usuario/reservaciones/cancelar', [
    'middleware' => 'auth',
    'uses' => 'ReservationController@cancelar'
]);
