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

                // Add these routes for report generation
                Route::get('/generate_blogs_report', 'BlogController@generate_report')
                        ->name('generate_blogs_report');

                Route::get('/export_blogs_csv',  'BlogController@export_csv')
                        ->name('export_blogs_csv');

                Route::get('/access_blogs', 'BlogController@access_blogs')
                        ->name('access_blogs');
                Route::get('/add_access', 'BlogController@add_access')
                        ->name('add_access');
                Route::post('/store_access', 'BlogController@store_access')
                        ->name('store_access');
                Route::get('/show_access', 'BlogController@show_access')
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

                // Add this route for generating PDF report 
                Route::get('/generate_genre_report', 'GenreController@generate_report')
                        ->name('generate_genre_report');

                Route::get('/users_list', 'UserController@index')
                        ->name('users_list');

                Route::put('/users_list/{id}/update-access', 'UserController@updateAccess')
                        ->name('update_user_access');

                // Add these routes for report generation
                Route::get('/generate_users_report', 'UserController@generate_report')->name('generate_users_report');
                
                Route::get('/export_users_csv', 'UserController@export_csv')->name('export_users_csv');

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

                // Add these routes for report generation 
                Route::get('/generate_sources_report', 'SourceController@generate_report')
                        ->name('generate_sources_report');

                Route::get('/export_sources_csv', 'SourceController@export_csv')->name('export_sources_csv');

                Route::get('/article_status', 'BlogController@article_status')
                        ->name('article_status');

                Route::get('/payments', 'PaymentController@index')
                        ->name('payments');

                Route::get('/add_payment', 'PaymentController@add_payment')
                        ->name('add_payment');
                
                Route::post('/save_payment', 'PaymentController@save_payment')
                        ->name('save_payment');

                Route::get('/edit_payment/{id}', 'PaymentController@edit_payment')
                        ->name('edit_payment');

                Route::post('/update_payment/{id}', 'PaymentController@update_payment')
                        ->name('update_payment');

                Route::delete('/delete_payment/{id}', 'PaymentController@delete_payment')
                        ->name('delete_payment');

                Route::get('/generate_payments_report', 'PaymentController@generate_report')
                        ->name('generate_payments_report');

                Route::get('/export_payments_csv', 'PaymentController@export_csv')->name('export_payments_csv');

                Route::get('/pending_transaction', 'TransactionController@pending_transaction')
                        ->name('pending_transaction');

                Route::get('/cancel_transaction', 'TransactionController@cancel_transaction')
                        ->name('cancel_transaction');

                Route::get('/success_transaction', 'TransactionController@success_transaction')
                        ->name('success_transaction');

                Route::get('/members', 'MemberController@index')
                        ->name('members');
                
                // Add route for generating PDF report
                Route::get('/members/report', 'MemberController@generateReport')
                        ->name('members_report');

                Route::get('/add_member', 'MemberController@add_member')
                        ->name('add_member');

                Route::post('/save_member', 'MemberController@save_member')
                        ->name('save_member');

                Route::get('/edit_member/{id}', 'MemberController@edit_member')
                        ->name('edit_member');

                Route::post('/update_member/{id}', 'MemberController@update_member')
                        ->name('update_member');
                
                Route::delete('/delete_member/{id}', 'MemberController@delete_member')
                        ->name('delete_member');
        });
Route::prefix('home')
        ->namespace('User')
        ->middleware(['auth', 'user'])
        ->group(function() {
                Route::get('/', 'DashboardController@index')
                        ->name('home');
                Route::get('/detail/{id}', 'DashboardController@detail')
                        ->name('detail');
                Route::get('/article_list', 'DashboardController@article_list')
                        ->name('article_list');

                Route::get('/profile', 'ProfileController@detail')
                        ->name('profile');
                Route::get('/edit_profile', 'ProfileController@edit_profile')
                        ->name('edit_profile');

                Route::post('/update_profile', 'ProfileController@update_profile')
                        ->name('update_profile');

                Route::get('/upgrade_article', 'UpgradeController@index')
                        ->name('upgrade_article');

                Route::get('/main_page', 'MembershipController@main_page')
                        ->name('main_page');

                Route::get('/edit_membership', 'MembershipController@edit_membership')
                        ->name('edit_membership');
        });