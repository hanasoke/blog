<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;

class UpgradeController extends Controller
{
    public function index() {
        // Ambil semua blog dengan relasi genre, source, dan user 
        $blogs = Blog::with(['genre', 'source', 'user'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('pages.user.upgrade.index', compact('blogs'));
    }

    public function detail($id) {
        return view('pages.user.detail');
    }
}
