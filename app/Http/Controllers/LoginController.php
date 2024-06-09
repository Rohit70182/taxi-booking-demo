<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Helpers\LogActivity;
use App\Models\User;
use PHPUnit\Exception;
use Helper;
use Modules\Smtp\helpers\MailHelper;

class LoginController extends Controller
{
    /**
     * Login View.
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        } else {
            return view('auth.login');
        }
    }

    /**
     * Attempt Login.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function login(Request $request)
    {
        
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
            $remember_me = $request->has('remember_me') ? true : false;
            
            if (Auth::attempt($credentials, $remember_me)) {
                $request->session()->regenerate();
                LogActivity::addToLog('Login Attempt');
                return redirect('/dashboard');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        } catch (Exception $e) {
            LogActivity::addToLog($e->getMessage());
            return redirect()->back();
        }
    }
}
