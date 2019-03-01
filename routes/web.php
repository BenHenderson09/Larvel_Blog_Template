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

// Basic navigation routes
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/guidelines', 'PagesController@guidelines');

// Posts
Route::resource('posts', 'PostsController');

// Custom logout route
Route::get('/logout', 'Auth\LogoutController@logout');

// User details
Route::get('/user', 'UserController@index')->name('user.index');
Route::get('/user/edit', 'UserController@edit')->name('user.edit');
Route::put('/user', 'UserController@update')->name('user.update');
Route::delete('/user', 'UserController@destroy')->name('user.destroy');

Auth::routes();
