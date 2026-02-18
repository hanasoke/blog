<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->roles === 'USER')
        return $next($request);

        // kalau admin nyasar ke user -> lempar ke admin 
        if(Auth::check() && Auth::user()->roles === 'ADMIN') {
            return  redirect('/admin');
        }

        return redirect('/login');
    }
}
