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
    Route::get('/', 'App\Http\Controllers\UserController@index');
    Route::post('/registerAdmin', 'App\Http\Controllers\UserController@registerAdmin');
    Route::post('/login', 'App\Http\Controllers\UserController@login');
    Route::post('/store', 'App\Http\Controllers\UserController@store');
});

Route::group(['prefix' => '/garage'], function (){
    Route::get('/', 'App\Http\Controllers\GarageController@index');
    Route::get('/show/{id}', 'App\Http\Controllers\GarageController@show');
    Route::post('/store', 'App\Http\Controllers\GarageController@store');
    Route::put('/update/{id}', 'App\Http\Controllers\GarageController@update');
    Route::delete('/delete/{id}', 'App\Http\Controllers\GarageController@delete');
});

Route::group(['prefix' => '/garage_rate'], function (){
    Route::get('/', 'App\Http\Controllers\GarageRateController@index');
    Route::get('/show/{id}', 'App\Http\Controllers\GarageRateController@show');
    Route::post('/store', 'App\Http\Controllers\GarageRateController@store');
    Route::put('/update/{id}', 'App\Http\Controllers\GarageRateController@update');
    Route::delete('/delete/{id}', 'App\Http\Controllers\GarageRateController@delete');
});

Route::group(['prefix' => '/garage_photo'], function (){
    Route::get('/', 'App\Http\Controllers\GaragePhotoController@index');
    Route::get('/show/{id}', 'App\Http\Controllers\GaragePhotoController@show');
    Route::post('/store', 'App\Http\Controllers\GaragePhotoController@store');
    Route::POST('/update/{id}', 'App\Http\Controllers\GaragePhotoController@update');
    Route::delete('/delete/{id}', 'App\Http\Controllers\GaragePhotoController@delete');
});

Route::group(['prefix' => '/transaction'], function (){
    Route::get('/', 'App\Http\Controllers\TransactionController@index');
    Route::post('/in', 'App\Http\Controllers\TransactionController@car_in');
    Route::post('/out', 'App\Http\Controllers\TransactionController@car_out');
});
