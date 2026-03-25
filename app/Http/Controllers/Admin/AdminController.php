<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller 
{
    public function admin_profile() {
        return view('pages.admin.profile.admin_profile');
    }

    public function edit_profile() {
        return view('pages.admin.profile.edit_profile');
    }
}