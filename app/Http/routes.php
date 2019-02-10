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

Route::get('/', function () {
    return redirect('/cities');
});

Route::get('/cities', 'CityController@listar');


Route::get('/users/parametrize', 'UserController@parametrize');
Route::post('/users/parametrize', 'UserController@saveParameters');
