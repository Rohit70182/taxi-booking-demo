<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Hash;
use App\Helpers\LogActivity;
use App\Models\User;
use PHPUnit\Exception;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Register View.
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        } else {
            return view('auth.register');
        }
    }

    /**
     * Register new user.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function signup(Request $request)
    {
        try {
            $request->validate(
                [
                    'name' => 'required|string|max:20',
                    'email' => 'required|email|unique:users,email',
                    'password' => ['required', 'string', 'min:8'],
                ]
            );
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->role = User::ROLE_USER;
            $user->password = Hash::make($request->password);
            $user->activation_key = $user->generateAuthKey();
            $user->referral_code = Str::random(8);
            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extenstion;
                $file->move('public/uploads/', $filename);
                $user->image = $filename;
            }
            $user->save();

         app('mailhelper')->sendRegistrationMailToAdmin($user , true);
            //app('mailhelper')->sendRegistrationMailToUser($user , true);
            if ($user->id != null) {
                Notification::create([
                    'title' => $user->name . ' Added',
                    'description' => 'A new User has been added',
                    'model_id' => $user->id,
                    'model_type' => 'User',
                    'to_user_id' => User::ROLE_ADMIN,
                    'created_by_id' => $user->id,
                ]);

                if ($user) {
                    return redirect('/login')->with('message', "Success! Registration completed ,You can login now");
                } else {
                    return back()->with('error', "There's an issue that has occurred, please try again");
                }
            }
        } catch (\Exception $e) {
            LogActivity::addToLog($e->getMessage());
            return redirect()->back();
        }
    }
}
