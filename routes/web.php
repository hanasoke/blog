<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
        ->name('home');

Route::prefix('admin')
        ->namespace('Admin')
        ->middleware(['auth', 'admin'])
        ->group(function() {
                Route::get('/', 'DashboardController@index')
                        ->name('dashboard');
                Route::get('/blogs_data', 'DashboardController@blogs_data')
                        ->name('blogs_data');
                Route::get('/add_blog', 'DashboardController@add_blog')
                        ->name('add_blog');
        });
Route::prefix('home')
        ->namespace('User')
        ->middleware(['auth', 'user'])
        ->group(function() {
                Route::get('/', 'DashboardController@index')
                        ->name('home');
                Route::get('/detail', 'DashboardController@detail')
                        ->name('detail');
        });