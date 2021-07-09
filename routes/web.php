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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// UserController

Route::get('user/{id}', 'App\Http\Controllers\UserController@show');

Route::post('user/{id}/edit', 'App\Http\Controllers\UserController@edit');

Route::put('user/{id}', 'App\Http\Controllers\UserController@update');
