<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('pages.admin.base');
    }

    public function blogs_data() {
        return view('pages.admin.blogs_data');
    }

    public function add_blog() {
        return view('pages.admin.add_blog');
    }
    
    public function add_genre() {
        return view('pages.admin.add_genre');
    }

    public function genre_lists() {
        return view('pages.admin.genre_lists');
    }
}
