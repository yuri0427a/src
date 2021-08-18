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


// CommentController

Route::resource('/comments', App\Http\Controllers\CommentController::class, ['only' => ['index', 'create', 'destroy']]);

// AnswerController

Route::resource('/comment_favorites', App\Http\Controllers\CommentFavoriteController::class, ['only' => ['create', 'destroy']]);

// VoteController
Route::put('/votes/vote', [App\Http\Controllers\VoteController::class,  "vote"])->name('votes.vote');


//管理者

// QuestionController

Route::get('/admin/quesitons', [App\Http\Controllers\Admin\QuestionController::class,  "index"])
->name("admin.questions.index");

Route::get('/admin/questions/{id}', [App\Http\Controllers\Admin\QuestionController::class,  "show"])
->name("admin.questions.show");

Route::delete('/admin/questions/{id}', [App\Http\Controllers\Admin\QuestionController::class,  "destroy"])
->middleware('auth:admin')->name("admin.questions.destroy");
