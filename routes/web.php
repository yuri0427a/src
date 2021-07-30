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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// UserController

Route::get('/users/{id}', [App\Http\Controllers\UserController::class,  "show"])
->middleware('auth')->name("users.show");


Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class,  "edit"])
->middleware('auth')->name("users.edit");

Route::post('/users/{id}', [App\Http\Controllers\UserController::class,  "update"])
->middleware('auth')->name('users.update');


// QuestionController

Route::get('/', [App\Http\Controllers\QuestionController::class,  "index"])
->name("questions.index");

Route::get('/questions/create', [App\Http\Controllers\QuestionController::class,  "create"])->name("questions.create");
Route::post('/questions/create', [App\Http\Controllers\QuestionController::class,  "store"])->name("questions.store");



// Route::resource('/questions', App\Http\Controllers\QuestionController::class, ['only' => ['index', 'create', 'show', 'destroy']]);

// CommentController

Route::resource('/comments', App\Http\Controllers\CommentController::class, ['only' => ['index', 'create', 'destroy']]);


// AnswerController

Route::resource('/comment_favorites', App\Http\Controllers\CommentFavoriteController::class, ['only' => ['create', 'destroy']]);


// VoteController

Route::resource('/votes', App\Http\Controllers\VoteController::class, ['only' => ['index', 'create']]);
