<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;

class MembershipController extends Controller 
{
    public function main_page() {
        return view('pages.user.upgrade.index');
    }

    public function edit_membership() {
        return view('pages.user.upgrade.edit_membership');
    }

}