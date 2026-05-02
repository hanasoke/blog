<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
use Illuminate\Validation\Rule;

class MemberController extends Controller 
{
    public function index() {
        $members = Member::orderBy('id', 'DESC')->get();
        return view('pages.admin.members.index', compact('members'));
    }
    
    public function add_member() {
        return view('pages.admin.members.add_member');
    }

    public function save_member(Request $request) {
        $request->validate([
            'name' => 'required|unique:members,name',
            'price' => 'required|numeric|min:0'
        ], [
            'name.required' => 'Membership Grade must be filled',
            'name.unique' => 'Membership Grade has existed',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number'
        ]);

        Member::create([
            'name'  => $request->name,
            'price' => $request->price
        ]);

        return redirect()
            ->route('members')
            ->with('success', 'Membership Grade has been added');

    }

    public function edit_member($id) {
        $member = Member::findOrFail($id);
        return view('pages.admin.members.edit_member', compact('member'));
    }

    public function delete_member() {

        return redirect()
            ->route('index');
    }
}

?>