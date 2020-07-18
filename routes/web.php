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

Route::get('/','Frontend\FrontendController@homePage')->name('homepage');

Route::get('/posts','Frontend\FrontendController@posts')->name('postspage');
Route::get('/posts/{name}','Frontend\FrontendController@postPage')->name('postdetails');

Route::get('/login','Backend\AuthController@loginForm')->name('loginForm');
Route::post('/login','Backend\AuthController@login')->name('login');

Route::get('/registration','Backend\AuthController@registrationForm')->name('registrationForm');
Route::post('/registration','Backend\AuthController@register')->name('register');

Route::get('/profile','Backend\AuthController@registrationForm')->name('profile');
Route::get('/logout','Backend\AuthController@logout')->name('logout');

Route::get('/dashbord','Backend\AuthController@dashboard')->name('dashbord');
