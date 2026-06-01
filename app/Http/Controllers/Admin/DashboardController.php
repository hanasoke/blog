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
        
        // Blog with most views (if you have views column, adjust accordingly)
        $mostViewedBlog = Blog::with('user')
            ->orderBy('created_at', 'desc')
            ->first();

        // Latest blogs
        $latestBlogs = Blog::with(['user', 'genre', 'source'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Transaction statistics
        $totalTransactions = Transaction::count();
        $pendingTransactions = Transaction::where('status', Transaction::STATUS_PENDING)->count();
        $approvedTransactions = Transaction::where('status', Transaction::STATUS_APPROVED)->count();
        $rejectedTransactions = Transaction::where('status', Transaction::STATUS_REJECTED)->count();

        // Transaction revenue
        $totalRevenue = Transaction::where('status', Transaction::STATUS_APPROVED)
            ->get()
            ->sum(function($transaction) {
                return $transaction->member->price ?? 0;
            });

        $pendingRevenue = Transaction::where('status', Transaction::STATUS_PENDING)
            ->get()
            ->sum(function($transaction) {
                return $transaction->member->price ?? 0;
            });

         $rejectedRevenue = Transaction::where('status', Transaction::STATUS_REJECTED)
            ->get()
            ->sum(function($transaction) {
                return $transaction->member->price ?? 0;
            });

        // Member/Package statistics
        $totalMembers = Member::count();
        $memberStats = Member::withCount('accessBlog')->get();

        // Payment method statistics
        $totalPayments = Payment::count();
        $paymentStats = Payment::withCount('transactions')->get();

        // Access blog statistics
        $totalAccessBlogs = AccessBlog::count();

        // Monthly user registration (last 6 months)
        $monthlyUserStats = [];
        for($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $count = User::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            $monthlyUserStats[$month->format('F Y')] = $count;
        }
        
        // Monthly transaction statistics (last 6 months)
        $monthlyTransactionStats = [];
        for($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $count = Transaction::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            $revenue = Transaction::where('status', Transaction::STATUS_APPROVED)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->get()
                ->sum(function($t) {
                    return $t->member->price ?? 0;
                });
            $monthlyTransactionStats[$month->format('F Y')] = [
                'count' => $count,
                'revenue' => $revenue
            ];
        }
        
        // Genre statistics (most used)
        $genreStats = Genre::withCount('blogs')
            ->orderBy('blogs_count', 'desc')
            ->limit(5)
            ->get();
        
        // Source statistics (most used)
        $sourceStats = Source::withCount('blogs')
            ->orderBy('blogs_count', 'desc')
            ->limit(5)
            ->get();
        
        // Prepare data for view
        $data = [
            // User stats
            'totalUsers' => $totalUsers,
            'totalAdmin' => $totalAdmin,
            'totalRegularUsers' => $totalRegularUsers,
            'verifiedUsers' => $verifiedUsers,
            'unverifiedUsers' => $unverifiedUsers,
            'userAccessStats' => $userAccessStats,
            'monthlyUserStats' => $monthlyUserStats,
            
            // Blog stats
            'totalBlogs' => $totalBlogs,
            'totalGenres' => $totalGenres,
            'totalSources' => $totalSources,
            'mostViewedBlog' => $mostViewedBlog,
            'latestBlogs' => $latestBlogs,
            'genreStats' => $genreStats,
            'sourceStats' => $sourceStats,
            
            // Transaction stats
            'totalTransactions' => $totalTransactions,
            'pendingTransactions' => $pendingTransactions,
            'approvedTransactions' => $approvedTransactions,
            'rejectedTransactions' => $rejectedTransactions,
            'totalRevenue' => $totalRevenue,
            'pendingRevenue' => $pendingRevenue,
            'rejectedRevenue' => $rejectedRevenue,
            'monthlyTransactionStats' => $monthlyTransactionStats,
            
            // Member & Payment stats
            'totalMembers' => $totalMembers,
            'memberStats' => $memberStats,
            'totalPayments' => $totalPayments,
            'paymentStats' => $paymentStats,
            
            // Access Blog stats
            'totalAccessBlogs' => $totalAccessBlogs,
        ];


        return view('pages.admin.base', $data);
    }
}
