<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller 
{
    public function admin_profile() 
    {
        $admin = Auth::user();

        return view('pages.admin.profile.admin_profile', compact('admin'));
    }

    public function edit_profile() 
    {
        $admin = Auth::user();

        return view('pages.admin.profile.edit_profile', compact('admin'));
    }
}