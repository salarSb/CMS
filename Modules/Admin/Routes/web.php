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
    Route::get('/posts-data', 'AdminPostController@data')->name('posts.data');
    Route::post('/activate/posts/{post}', 'AdminPostController@activate')->name('posts.activate');

    Route::resource('/categories', 'AdminCategoryController');
    Route::get('/categories-data', 'AdminCategoryController@data')->name('categories.data');

    Route::resource('/comments', 'CommentController');

    Route::resource('/tags', 'AdminTagController');
    Route::get('/tags-data', 'AdminTagController@data')->name('tags.data');

    Route::resource('/themes', 'AdminThemeController');
    Route::get('/themes-data', 'AdminThemeController@data')->name('themes.data');
    Route::post('/activate/themes/{theme}', 'AdminThemeController@activate')->name('themes.activate');
});
