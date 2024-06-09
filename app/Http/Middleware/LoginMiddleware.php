<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoginMiddleware
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
        $loginField = $request->input('username');

        // check if the login field is an email or phone number
        if (filter_var($loginField, FILTER_VALIDATE_EMAIL)) {
            config(['auth.defaults.guard' => 'web']); 
        } else {
            config(['auth.defaults.guard' => 'username']); 
        }

        return $next($request);
    }
}

