<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.user.home');
    }

    public function test()
    {
        return view('pages.test');
    }

    public function blogs()
    {
        return view('pages.blogs');
    }

    public function blogs_2()
    {
        return view('pages.blogs_2');
    }
}
