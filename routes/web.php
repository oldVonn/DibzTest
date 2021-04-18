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


Route::get('/garage', 'App\Http\Controllers\GarageController@index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::prefix('/login')
//     ->as('tbluser.')
//     ->group(function() {
//         Route::get('/', function () {
//                 return view('welcome');
//             });
//         Route::namespace('Auth\Login')
//             ->group(function() {
//                 Route::get('login', 'TblUserController@showLoginForm')->name('login');
//                 Route::post('login', 'TblUserController@login')->name('login');
//                 Route::post('logout', 'TblUserController@logout')->name('logout');
//         });
//  });
Auth::routes();