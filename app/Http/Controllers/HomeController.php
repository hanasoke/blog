<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blogs = Blog::with(['genre', 'source', 'user'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('pages.user.home', compact('blogs'));
    }

    public function detail() {
        return view('pages.user.detail');
    }
}
