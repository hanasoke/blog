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
        ->group(function() {
                Route::get('/', 'DashboardController@index')
                        ->name('dashboard');
        });
Route::get('/home', 'DashboardController@index')
        ->namespace('User')
        ->group(function() {
                Route::get('/', 'DashboardController@index')
                        ->name('dashboard');
        });