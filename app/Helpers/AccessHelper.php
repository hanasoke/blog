<?php

namespace App\Helpers;

use App\Blog;
use App\User;

class AccessHelper 
{
    // Access level hierarchy
    const ACCESS_LEVELS = [
        'FREE' => 0,
        'BASIC' => 1,
        'PREMIUM' => 2,
        'VIP' => 3
    ];

    // Check if user can access a blog 
    public static function canAccessBlog(User $user, Blog $blog)
    {
        // VIP can access everything
        if($user->access == 'VIP') {
            return true; 
        }

        // No access restriction 
        if(!$blog->access || !$blog->access->member) {
            return true;
        }

        $userLevel = self::ACCESS_LEVELS[$user->access] ?? 0;
        $requiredLevel = self::ACCESS_LEVELS[$blog->access->member->name] ?? 0;

        return $userLevel >= $requiredLevel;
    }

    // Get required access level for a blog 
    public static function getRequiredLevel(Blog $blog)
    {
        if($blog->access && $blog->access->member) {
            return $blog->access->member->name;
        }
        return 'FREE';
    }
}