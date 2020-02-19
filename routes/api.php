<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Auth::routes();

Route::get('/client', 'ClientController@index')->name('client.list');
Route::post('/client/register', 'ClientController@store')->name('client.store');
Route::put('/client/update/{id}', 'ClientController@update')->name('client.list');
Route::delete('/client/delete/{id}', 'ClientController@destroy')->name('client.destroy');

Route::get('/billetera', 'WallerController@index')->name('billetera.list');
Route::post('/billetera/register', 'WallerController@store')->name('billetera.store');
Route::get('/getClientes', 'WallerController@getClientes')->name('getClientes');
Route::put('/billetera/update/{id}', 'WallerController@update')->name('billetera.list');
Route::delete('/billetera/delete/{id}', 'WallerController@destroy')->name('billetera.destroy');



