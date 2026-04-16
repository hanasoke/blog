<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\User;

class ProfileController extends Controller
{
    public function detail() {
        // Get currently logged in user 
        $user = Auth::user();

        return view('pages.user.dashboard.view_profile', compact('user'));
    }

    public function edit_profile() {
        // Get currently logged in user 
        $user = Auth::user();

        return view('pages.user.dashboard.edit_profile', compact('user'));
    }


}
