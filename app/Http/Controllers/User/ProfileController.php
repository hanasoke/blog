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

    public function update_profile(Request $request)
    {
        $user = Auth::user();

        // Validation rules 
        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|digits_between:10,15|unique:users,phone,' . $user->id,
            'birthdate' => 'required|date',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ];

        // Custom error messages 
        $messages = [
            'name.required' => 'Full name is required.',
            'username.required' => 'Username is required.',
            'username.unique' => 'This username has already been taken.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email has already been registered.',
            'phone.required' => 'Phone number is required.',
            'phone.digits_between' => 'Phone number must be between 10-15 digits.',
            'phone.unique' => 'This phone number has already been registered.',
            'birthdate.required' => 'Birthdate is required.',
            'photo.image' => 'Photo must be an image file.',
            'photo.mimes' => 'Photo must be a JPG, JPEG, or PNG file.',
            'photo.max' => 'Photo size must not exceed 2MB.',
            'current_password.required_with' => 'Current password is required to change password.',
            'new_password.min' => 'New password must be at least 8 characters.',
            'new_password.confirmed' => 'New password confirmation does not match.',
        ];

        // Validate request
        $this->validate($request, $rules, $messages);
        
        // Check current password if changing password
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()
                    ->with('error', 'Current password is incorrect.')
                    ->withInput();
            }
        }

        // Handle photo upload 
        if($request->hasFile('photo')) {
            // Delete old photo if exists 
            if($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            $photoPath = $request->file('photo')->store('users', 'public');
            $user->photo = $photoPath;
        }

        // Update user data 
        


    }


}
