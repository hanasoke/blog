<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        //
    }

    protected function authenticated($request, $user)
    {
        if (!$user->hasVerifiedEmail()) {
            auth()->logout();
            return redirect('/login')
                ->with('error', 'Silahkan verifikasi email terlebih dahulu.');
        }

        if($user->roles === 'ADMIN') {
            return redirect('/admin');
        }

        return redirect('/home');
    }

    protected function loggedOut(Request $request)
    {
        return redirect('/login')->with('status', 'Berhasil logout.');
    }
}
