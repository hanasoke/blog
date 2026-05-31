<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Blog;
use App\Genre;
use App\Source;
use App\Member;
use App\Payment;
use App\Transaction;
use App\AccessBlog;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() 
    {
        // User statistics
        $totalUsers = User::count();
        $totalAdmin = User::where('roles', 'ADMIN')->count();
        $totalRegularUsers = User::where('roles', 'USER')->count();
        $verifiedUsers = User::whereNotNull('email_verified_at')->count();
        $unverifiedUsers = $totalUsers - $verifiedUsers;

        // User access level distribution 
        $userAccessStats = [
            'FREE' => User::where('access', 'FREE')->count(),
            'BASIC' => User::where('access', 'BASIC')->count(),
            'PREMIUM' => User::where('access', 'PREMIUM')->count(),
            'VIP' => User::where('access', 'VIP')->count(),
        ];

        // Blog statistics 
        $totalBlogs = Blog::count();
        $totalGenres = Genre::count();
        $totalSources = Source::count();
        

        return view('pages.admin.base');
    }
}
