<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Vendor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role !== User::ROLE_VENDOR) {
            return redirect('/dashboard')->with('error', "Access Denied , You are not allowed to perform this action");
        }
        
        return $next($request);
    }
}
