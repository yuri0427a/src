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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 管理者
Route::prefix('admin')->name('admin.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:admin')->group(function () {

        // TOPページ
        Route::resource('/home', App\Http\Controllers\Admin\HomeController::class, ['only' => 'index']);

    });

});

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

Route::get('/questions/create', [App\Http\Controllers\QuestionController::class,  "create"])
->middleware('auth')->name("questions.create");

Route::post('/questions/store', [App\Http\Controllers\QuestionController::class,  "store"])
->middleware('auth')->name("questions.store");

Route::get('/questions/{id}', [App\Http\Controllers\QuestionController::class,  "show"])
->name("questions.show");

Route::delete('/questions/{id}', [App\Http\Controllers\QuestionController::class,  "destroy"])
->middleware('auth')->name("questions.destroy");

// VoteController
Route::put('/votes/vote', [App\Http\Controllers\VoteController::class,  "vote"])->name('votes.vote');

// CommentController

Route::get('/comments', [App\Http\Controllers\CommentController::class,  "index"])
->name("comments.index");

Route::post('/comments/store', [App\Http\Controllers\CommentController::class,  "store"])
->middleware('auth')->name("comments.store");

Route::delete('/comments/{id}', [App\Http\Controllers\CommentController::class,  "destroy"])
->middleware('auth')->name("comments.destroy");



//管理者

// QuestionController

Route::get('/admin/quesitons', [App\Http\Controllers\Admin\QuestionController::class,  "index"])
->name("admin.questions.index");

Route::delete('/admin/questions/{id}', [App\Http\Controllers\Admin\QuestionController::class,  "destroy"])
->middleware('auth:admin')->name("admin.questions.destroy");

// UserController

Route::get('/admin/users', [App\Http\Controllers\Admin\UserController::class,  "index"])
->name("admin.users.index");

Route::get('/admin/users/{id}', [App\Http\Controllers\Admin\UserController::class,  "show"])
->middleware('auth:admin')->name("admin.users.show");

Route::get('/admin/users/{id}/edit', [App\Http\Controllers\Admin\UserController::class,  "edit"])
->middleware('auth:admin')->name("admin.users.edit");

Route::post('/admin/users/{id}', [App\Http\Controllers\Admin\UserController::class,  "update"])
->middleware('auth:admin')->name("admin.users.update");

Route::delete('/admin/users/{id}', [App\Http\Controllers\Admin\UserController::class,  "destroy"])
->middleware('auth:admin')->name("admin.users.destroy");


// CommentController


