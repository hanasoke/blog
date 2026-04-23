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
                        ->name('admin_profile');

                Route::get('/edit_profile', 'AdminController@edit_profile') 
                        ->name('edit_profile');

                Route::post('/edit_profile', 'AdminController@update_profile')
                        ->name('update_profile');

                Route::get('/blogs_data', 'BlogController@blogs_data')
                        ->name('blogs_data');
                Route::get('/add_blog', 'BlogController@add_blog')
                        ->name('add_blog');
                Route::post('/store_blog', 'BlogController@store_blog')
                        ->name('store_blog');
                Route::get('/edit_blog/{id}', 'BlogController@edit_blog')
                        ->name('edit_blog');
                Route::put('/update_blog/{id}', 'BlogController@update_blog')
                        ->name('update_blog');
                Route::delete('/delete_blog/{id}', 'BlogController@delete_blog')
                        ->name('delete_blog');
                        

                Route::get('/access_blogs', 'BlogController@access_blogs')
                        ->name('access_blogs');
                Route::get('/add_access', 'BlogController@add_access')
                        ->name('add_access');
                Route::post('/store_access', 'BlogController@store_access')
                        ->name('store_access');
                Route::get('/show_access/{id}', 'BlogController@show_access')
                        ->name('show_access');
                Route::get('/edit_access/{id}', 'BlogController@edit_access')
                        ->name('edit_access');
                Route::put('/update_access/{id}', 'BlogController@update_access')
                        ->name('update_access');
                Route::delete('/delete_access/{id}', 'BlogController@delete_access')
                        ->name('delete_access');

                Route::get('/genre_lists', 'GenreController@genre_lists')
                        ->name('genre_lists');

                Route::get('/add_genre', 'GenreController@add_genre')
                        ->name('add_genre');
                Route::post('/add_genre', 'GenreController@store_genre')
                        ->name('store_genre');

                Route::get('/edit_genre/{id}', 'GenreController@edit_genre')
                        ->name('edit_genre');
                Route::post('/update_genre/{id}', 'GenreController@update_genre')
                        ->name('update_genre');
                Route::delete('/delete_genre/{id}', 'GenreController@delete_genre')
                        ->name('delete_genre');

                Route::get('/users_list', 'UserController@index')
                        ->name('users_list');

                Route::put('/users_list/{id}/update-access', 'UserController@updateAccess')
                        ->name('update_user_access');

                Route::get('/sources_list', 'SourceController@sources_list')
                        ->name('sources_list');

                Route::get('/add_source', 'SourceController@add_source')
                        ->name('add_source');

                Route::get('/edit_source/{id}', 'SourceController@edit_source')
                        ->name('edit_source');
                
                Route::post('/adding_source', 'SourceController@adding_source')
                        ->name('adding_source');

                Route::post('/update_source/{id}', 'SourceController@update_source')
                        ->name('update_source');
                Route::delete('/delete_source/{id}', 'SourceController@delete_source')
                        ->name('delete_source');

                Route::get('/article_status', 'BlogController@article_status')
                        ->name('article_status');

        });
Route::prefix('home')
        ->namespace('User')
        ->middleware(['auth', 'user'])
        ->group(function() {
                Route::get('/', 'DashboardController@index')
                        ->name('home');
                Route::get('/detail/{id}', 'DashboardController@detail')
                        ->name('detail');
                Route::get('/profile', 'ProfileController@detail')
                        ->name('profile');
                Route::get('/edit_profile', 'ProfileController@edit_profile')
                        ->name('edit_profile');

                Route::post('/update_profile', 'ProfileController@update_profile')
                        ->name('update_profile');
        });