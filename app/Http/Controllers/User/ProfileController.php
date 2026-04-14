<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function detail() {
        return view('pages.user.dashboard.view_profile');
    }


}
