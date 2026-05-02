<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
use Illuminate\Validation\Rule;

class MemberController extends Controller 
{
    public function index() {
        return view('pages.admin.members.index');
    }
    
    public function add_member() {
        return view('pages.admin.members.add_member');
    }

    public function edit_member() {
        return view('pages.admin.members.edit_member');
    }

    public function delete_member() {

        return redirect()
            ->route('index');
    }
}

?>