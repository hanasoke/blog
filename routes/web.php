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


Route::namespace('User')
        ->middleware(['auth', 'verified'])
        ->group(function() {
                Route::get('/home', 'DashboardController@index')
                        ->name('home');
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
                
                Route::post('/', 'RegisterController@store')
                        ->name('register');
        });

// notice
Route::get('/email/verify', function () {
    return view('pages.sign.verification');
})->middleware('auth')->name('verification.notice');

// verify link
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/login')->with('success', 'Email verified successfully!');
})->middleware(['auth', 'signed'])->name('verification.verify');

// resend
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');