<?php

namespace App\Http\Middleware;

use App\Admin;
use Closure;
use Illuminate\Support\Facades\Cookie;

class AdminLogin
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

        if (Cookie::has('remember_token')) {

            if (session()->has('remember_token')) return $next($request);

            $admin = Admin::where('remember_token', Cookie::get('remember_token'))->first();

            if ($admin) {

                session()->put('user_id', $admin->user_id);
                session()->put('remember_token', $admin->remember_token);

                return $next($request);
            }
        }

        return redirect()->route('loginForm');
    }
}
