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
    ->middleware(['auth', 'verified'])
    ->name('home');


Route::get('/user_page', 'HomeController@blogs')
        ->name('blogs');

Route::prefix('admin')
        ->namespace('Admin')
        ->middleware(['auth', 'admin'])
        ->group(function() {
                Route::get('/', 'DashboardController@index')
                        ->name('dashboard');
        });

// Routes authentication dengan verifikasi email
Auth::routes(['verify' => true]);

// Route untuk resend verification email
Route::get('/email/verify', 'Auth\VerificationController@show')
    ->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', 'Auth\VerificationController@verify')
    ->name('verification.verify');
Route::post('/email/resend', 'Auth\VerificationController@resend')
    ->name('verification.resend');
