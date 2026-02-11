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

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')
        // ->middleware(['auth', 'verified'])
        ->name('home');


Route::prefix('user')
        ->namespace('User')
        ->middleware(['auth', 'verified'])
        ->group(function() {
                Route::get('/home', 'DashboardController@index')
                        ->name('dashboard');
        });

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
