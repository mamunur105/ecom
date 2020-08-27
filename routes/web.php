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

Route::get('/', 'Frontend\FrontendController@homePage')->name('homepage');

Route::get('/login', 'Backend\AuthController@loginForm')->name('loginForm');
Route::post('/login', 'Backend\AuthController@login');

Route::get('/registration', 'Backend\AuthController@registrationForm')->name('registrationForm');
Route::post('/registration', 'Backend\AuthController@register');

Route::get('/verify/{token}', 'Backend\AuthController@verification')->name('verification');
Route::get('/profile', 'Backend\AuthController@registrationForm')->name('profile');
Route::get('/logout', 'Backend\AuthController@logout')->name('logout');

// With A Route Closure...

Route::get('/dashbord', 'Backend\AuthController@dashboard')->name('dashbord');

Route::get('/category', 'Backend\CategoryController@index')->name('category.index');
Route::post('/category/add', 'Backend\CategoryController@create')->name('category.add');
Route::get('/category/{id}/edit', 'Backend\CategoryController@edit')->name('category.edit');
Route::put('/category/{id}', 'Backend\CategoryController@update')->name('category.update');
Route::delete('/category/{id}', 'Backend\CategoryController@delete')->name('category.delete');

Route::resource('/posts', 'Backend\PostController');
Route::get('/posts/category/{id}/', 'Backend\PostController@postByCat')->name('category.show');
Route::get('/posts/user/{id}', 'Backend\PostController@userPost')->name('postbyuser');