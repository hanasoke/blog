<?php

namespace App\Http\Controllers\Sign;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function index() {
        return view('pages.sign.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255|unique:users,name',
            'username'  => 'required|string|max:255|unique:users,username',
            'email'     => 'required|email|max:255|unique:users,email',
            'password'  => 'required|min:6',
            'birthdate' => 'required|date',
            'phone'     => 'required',
            'photo'     => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // upload photo
        $photoPath = $request->file('photo')->store('users', 'public');

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthdate' => $request->birthdate,
            'phone' => $request->phone,
            'photo' => $photoPath,
            'roles' => 'USER',
            'access' => 'FREE',
        ]);

        event(new Registered($user));

        auth()->login($user); // tambahkan ini

        return redirect()->route('verification.notice');
    }

    public function verification() {
        return view('pages.sign.verification');
    }
}