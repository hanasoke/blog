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

Route::get('/', 'HomeController@index')
        ->name('home');

Route::get('/user_page', 'HomeController@blogs')
        ->name('blogs');

Route::get('/test', 'HomeController@test')
        ->name('test');

Route::get('/blogs', 'HomeController@blogs')
        ->name('blogs');

Route::get('/blogs_2', 'HomeController@blogs_2')
        ->name('blogs_2');

Route::prefix('admin')
        ->namespace('Admin')
        ->middleware(['auth', 'admin'])
        ->group(function() {
                Route::get('/', 'DashboardController@index')
                        ->name('dashboard');
        });


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
