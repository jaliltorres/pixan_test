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
    return view('index');
});

Route::post('registry', 'Auth\RegisterController@create');
Route::post('login', 'LoginpixanController@authenticate');
Route::post('logout', 'LoginpixanController@logout');

Route::group(array('prefix' => 'admin') ,function()
{
    // Ruta para el controlador del panel de admin
    Route::get('/index','AdminController@index');
    Route::get('/product/list','AdminController@getProducts');
    Route::post('/product/save','AdminController@saveProduct');
});
