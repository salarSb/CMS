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

Route::prefix('admin')->middleware(['checkAdmin', 'auth:sanctum', 'verified'])->group(function () {
    Route::get('/panel', 'AdminController@index')->name('admin.panel');
    Route::resource('/users', 'AdminUserController');
    Route::get('/users-data', 'AdminUserController@data')->name('users.data');
    Route::resource('/posts', 'AdminPostController');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/comments', 'CommentController');
    Route::resource('/tags', 'TagController');
    Route::resource('/themes', 'ThemeController');
});
