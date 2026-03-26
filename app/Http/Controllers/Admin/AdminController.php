<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function update_profile(Request $request) 
    {
        $admin = Auth::user();

        // ✅ VALIDATION
        $request->validate([
            'name'      => 'required|string|max:255|unique:users,name,' . $admin->id,
            'username'  => 'required|string|max:255|unique:users,username,' . $admin->id,
            'email'     => 'required|email|unique:users,email,' . $admin->id,
            'phone'     => [
                'required',
                'unique:users,phone,' . $admin->id, 
                'digits_between:10,15',
                'regex:/^[0-9]+$/'
            ],
            'birthdate' => 'required|date',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ UPDATE BASIC  DATA
        $data = $request->only([
            'name', 'username', 'email', 'phone', 'birthdate'
        ]);

        // ✅ UPLOAD PHOTO (IF AVAILABLE)
        if($request->hasFile('photo')) {

            // delete old photo
            if($admin->photo && Storage::disk('public')->exists($admin->photo)) {
                Storage::disk('public')->delete($admin->photo);
            }

            $data['photo'] = $request->file('photo')->store('users', 'public');
        }

        $admin->update($data);

        return redirect() 
            ->route('admin_profile')
            ->with('success', 'Profile berhasil diperbarui');
    }
}