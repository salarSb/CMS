<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\AuthController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/base', 'HomeController@base')->name('base');

Route::apiResource('posts', 'PostController', [
    'as' => 'api',
    'except' => ['show']
]);
Route::get('/posts/{post:slug}', 'PostController@show')->name('api.posts.show');

Route::get('/search/{text}', 'HomeController@search')->name('api.posts.search');

Route::apiResource('categories', 'CategoryController', [
    'as' => 'api'
]);

Route::apiResource('comments', 'CommentController', [
    'as' => 'api'
]);
Route::get('/post/comments/{post}', 'CommentController@index');
