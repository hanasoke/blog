<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;

class DashboardController extends Controller
{
    public function index() {
        // Ambil semua blog dengan relasi genre, source, dan user 
        $blogs = Blog::with(['genre', 'source', 'user'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('pages.user.home', compact('blogs'));
    }

    public function detail($id) {
        $blog = Blog::with(['genre', 'source', 'user'])->findOrFail($id);
        return view('pages.user.detail', compact('blog'));
    }

    public function article_list() {

        return view('pages.user.article_list.index');
    }
}
