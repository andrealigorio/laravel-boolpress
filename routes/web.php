<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', 'HomeController@index')->name('guests-homepage');
Route::get('/posts', 'PostController@index')->name('posts-index');
Route::get('/post/{slug}', 'PostController@show')->name('posts-show');
Route::get('/categories', 'CategoryController@index')->name('categories-index');
Route::get('/categories/{slug}', 'CategoryController@show')->name('categories-show');

Auth::routes();

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {
    Route::get('/', 'HomeController@index')
    ->name('admin-homepage');
});


