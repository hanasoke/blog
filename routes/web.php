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

                Route::get('/admin_profile', 'AdminController@admin_profile') 
                        ->name('view_admin_profile');

                Route::get('/blogs_data', 'BlogController@blogs_data')
                        ->name('blogs_data');
                Route::get('/add_blog', 'BlogController@add_blog')
                        ->name('add_blog');
                Route::get('/edit_blog', 'BlogController@edit_blog')
                        ->name('edit_blog');

                Route::get('/genre_lists', 'GenreController@genre_lists')
                        ->name('genre_lists');

                Route::get('/add_genre', 'GenreController@add_genre')
                        ->name('add_genre');
                Route::post('/add_genre', 'GenreController@store_genre')
                        ->name('store_genre');

                Route::get('/edit_genre/{id}', 'GenreController@edit_genre')
                        ->name('edit_genre');
                Route::post('/edit_genre{id}', 'GenreController@update_genre')
                        ->name('update_genre');
                Route::delete('/delete_genre/{id}', 'GenreController@delete_genre')
                        ->name('delete_genre');
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