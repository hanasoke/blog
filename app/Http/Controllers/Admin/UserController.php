<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller 
{
    public function index()
    {
        $users = User::where('roles', 'USER')->get();

        return view('pages.admin.users_data.index', compact('users'));
    }

    public function updateAccess(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->access = $request->access;
        $user->save();

        return redirect()->route('users_list')->with('success', 'User access updated successfully!');
    }
}