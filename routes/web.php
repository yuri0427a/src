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

Route::resource('/users', App\Http\Controllers\UserController::class, ['only' => ['show', 'edit', 'update']]);


// QuestionController

Route::resource('/questions', App\Http\Controllers\QuestionController::class, ['only' => ['index', 'create', 'show', 'destroy']]);

// CommentController

Route::resource('/comments', App\Http\Controllers\CommentController::class, ['only' => ['index', 'create', 'destroy']]);


// AnswerController

Route::resource('/comment_favorites', App\Http\Controllers\CommentFavoriteController::class, ['only' => ['create', 'destroy']]);


// VoteController

Route::resource('/votes', App\Http\Controllers\VoteController::class, ['only' => ['index', 'create']]);
