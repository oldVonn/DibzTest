<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => '/users'], function (){
    Route::post('/', 'UserController@index');
});



Route::group(['prefix' => '/garage'], function (){
    Route::get('/', 'App\Http\Controllers\GarageController@index');
    Route::get('/show/{id}', 'App\Http\Controllers\GarageController@show');
    Route::post('/store', 'App\Http\Controllers\GarageController@store');
    Route::put('/update/{id}', 'App\Http\Controllers\GarageController@update');
});
