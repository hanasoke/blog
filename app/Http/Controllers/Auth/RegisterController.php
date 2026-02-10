<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'birthdate' => ['required', 'date'],
            'phone' => ['required', 'string', 'max:20'],
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ], [
            'name.required' => 'Full Name Cannot be Null',
            'name.unique' => 'Full Name Already Exists',
            'username.required' => 'Username Cannot be Null',
            'username.unique' => 'Username Already Exists',
            'email.required' => 'Email Cannot be Null',
            'email.unique' => 'Email Already Exists',
            'password.required' => 'Password Cannot be Null',
            'birthdate.required' => 'Date of Birth Cannot be Null',
            'phone.required' => 'Phone Cannot be Null',
            'photo.required' => 'Photo Cannot be Null',
            'photo.image' => 'File must be an image',
            'photo.mimes' => 'Image must be jpeg, png, jpg, or gif',
            'photo.max' => 'Image size cannot exceed 2MB',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // Upload foto
        if (request()->hasFile('photo')) {
            $photoPath = request()->file('photo')->store('profile-photos', 'public');
        } else {
            $photoPath = 'profile-photos/default.png';
        }


        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'birthdate' => $data['birthdate'],
            'phone' => $data['phone'],
            'photo' => $photoPath,
            'roles' => 'USER',
            'access' => 'FREE',
            'email_verified_at' => null, // Pastikan belum terverifikasi 
        ]);
    }

    protected function register(Request $request) 
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));

        // Kirim email verifikasi
        $user->sendEmailVerificationNotification();
        return redirect($this->redirectPath())
            ->with('status', 'Registration successful! Please check your email for verification link.');
    }
}
