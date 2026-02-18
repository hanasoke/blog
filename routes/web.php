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
        });
Route::prefix('home')
        ->namespace('User')
        ->middleware(['auth', 'user'])
        ->group(function() {
                Route::get('/', 'DashboardController@index')
                        ->name('home');
        });

Route::prefix('password')
        ->namespace('Auth')
        ->group(function() {
                Route::get('/resetpassword', 'ResetPasswordController@reset')
                        ->name('resetpassword');
        });