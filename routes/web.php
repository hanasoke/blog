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

Route::prefix('admin')
        ->namespace('Admin')
        ->group(function() {
                Route::get('/', 'DashboardController@index')
                        ->name('dashboard');
        });

Route::prefix('login')
        ->namespace('Sign')
        ->group(function() {
                Route::get('/', 'LoginController@index')
                        ->name('login');
        });

Route::prefix('register')
        ->namespace('Sign')
        ->group(function() {
                Route::get('/', 'RegisterController@index')
                        ->name('register');

                Route::get('/verification', 'RegisterController@verification')
                        ->name('verification');
        });