<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use App\Helpers\AccessHelper;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        // Ambil semua blog dengan relasi genre, source, user, dan access 
        $blogs = Blog::with(['genre', 'source', 'user', 'access.member'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('pages.user.home', compact('blogs'));
    }

    public function detail($id) {
        $user = Auth::user();
        $blog = Blog::with(['genre', 'source', 'user', 'access.member'])->findOrFail($id);

        // Using helper method 
        if(!AccessHelper::canAccessBlog($user, $blog)) {
            $requiredLevel = AccessHelper::getRequiredLevel($blog);
            return redirect()->route('home')
                ->with('error', "This blog requires {$requiredLevel} membership. Your current level is {$user->access}. Please upgrade to access this content.");
        }

        return view('pages.user.detail', compact('blog'));
    }

    public function article_list() {

        return view('pages.user.article_list.index');
    }

    // Check if user has access to a blog 
    private function checkBlogAccess($user, $blog) 
    {
        // If user has VIP access, they can access all blogs 
        if($user->access == 'VIP') {
            return true;
        }

        // If blog has no access restriction (FREE for everyone)
        if(!$blog->access){
            return true;
        }

        // Get the required member level for this blog 
        $requiredMember = $blog->access->member;

        if(!$requiredMember) {
            return true; 
        }

        // Define access level hierarchy
        $accessLevels = [
            'FREE' => 0,
            'BASIC' => 1, 
            'PREMIUM' => 2,
            'VIP' => 3
        ];

        $userLevel = $accessLevels[$user->access] ?? 0;
        $requiredLevel = $accessLevels[$requiredMember->name] ?? 0;

        // User can access if their level is greater than or equal to required level 
        return $userLevel >= $requiredLevel;
    }
}
