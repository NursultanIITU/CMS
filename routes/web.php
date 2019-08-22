<?php

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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('blog/post/{post}', [\App\Http\Controllers\Blog\PostController::class, 'showblog'])->name('blog.showblog');
Route::get('blog/category/{category}', [\App\Http\Controllers\Blog\PostController::class, 'category'] )->name('blog.category');
Route::get('blog/tag/{tag}', [\App\Http\Controllers\Blog\PostController::class, 'tag'] )->name('blog.tag');

Auth::routes();

Route::middleware(['auth'])->group(function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categories', 'CategoriesController');
    Route::resource('posts', 'PostController');
    Route::resource('tags', 'TagController');
    Route::get('trashed-posts', 'PostController@trashed')->name('trashed');
    Route::put('restore-post/{post}', 'PostController@restore')->name('restore-post');
});

Route::middleware(['auth', 'admin'])->group(function (){
    Route::get('users', 'UsersController@index')->name('users.index');
    Route::post('users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
    Route::get('users/profile', 'UsersController@editProfile')->name('users.edit-profile');
    Route::put('users/update-profile', 'UsersController@updateProfile')->name('users.update-profile');
});