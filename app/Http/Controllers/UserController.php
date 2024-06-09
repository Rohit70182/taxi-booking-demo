<?php

namespace App\Http\Controllers;

use App\Models\EmergencyContact;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\HttpException;
use DB;

class UserController extends Controller
{
    public function users()
    {
        $count = User::where('role', '!=', User::ROLE_ADMIN)->paginate(8);
        return view('dashboard.user-management.users', compact('count'));
    }

    public function show($id)
    {
        $show = User::where('id', $id)->first();
        return view('dashboard.user-management.show', compact('show'));
    }


    /*
     * Delete
    */
    public function delete($id)
    {
        try {
            $user = User::where('id', $id)->first();
            if (!empty($user)) {
                $user->delete();
                return redirect('/dashboard/users');
            } else {
                return redirect()->back()->with('error', "user not found");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    /*
     * Open Form 
    */
    public function add()
    {
        return view('dashboard.user-management.adduser');
    }

    /*
     * Store Data
    */
    public function addUser(Request $req)
    {
        try {
            $validator = validator(
                $req->all(),
                [
                    'name' => 'required|string|max:20',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|string|min:8|string|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
                    'role' => 'required|integer',
                    'image'  => 'mimes:jpeg,png,jpg,svg,|max:2048'
                ]
            );
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }

            $user = new User();
            $user->name = $req->input('name');
            $user->email = $req->input('email');
            $user->role = $req->input('role');
            $user->password = Hash::make($req->password);

            if ($req->hasfile('image')) {
                $file = $req->file('image');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extenstion;
                $file->move('public/uploads', $filename);
                $user->image = $filename;
            }

            $user->save();
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
                    return redirect('/dashboard/users')->with('success', "Saved successfully");
                } else {
                    return redirect()->back()->with('error', "unexpected error occurred,Couldn't be saved");
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
    /*
     * Edit
    */

    public function edit($id)
    {
        $GetData = User::find($id);
        return view('dashboard.user-management.update', compact('GetData'));
    }
    /*
     * Update
    */
    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $user->name = $request->input('name');
            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extenstion;
                $file->move('public/uploads', $filename);
                $user->image = $filename;
            }
            if ($user->update()) {
                return redirect('/dashboard/users')->with('success', "Data has been Updated Successfully");
            } else {
                return redirect()->back()->with('error', "Error Occurred,Data Couldn't be Updated.");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function confirmEmail($id)
    {
        $user = User::where(
            'activation_key',
            $id
        )->first();
        if (!empty($user)) {
            $verified = $user->update(['email_verified' => User::EMAIL_VERIFIED, 'state_id' => User::STATE_ACTIVE, 'email_verified_at' => Carbon::now()]);
            if ($verified) {
                return redirect('login')->with('success', "Congratulations! your email is verified");
            }
        }
    }

    public function resetEmail()
    {
        return view('auth.recover');
    }

    public function recover(Request $request)
    {
        try {
            $validator = validator(
                $request->all(),
                [
                    'email_or_phone' => [
                        'required',
                        function ($attribute, $value, $fail) {
                            $user = User::where('email', $value)
                                ->orWhere('contact_no', $value)
                                ->first();
                            if (!$user) {
                                $fail('This' . ' ' . $value . ' is not registered');
                            }
                        },
                    ],
                ]
            );
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            $user = User::findByUsername($request->email_or_phone);
            if (!empty($user)) {
                $user->generatePasswordResetToken();
                if (!$user->update()) {
                    throw new HttpException("Can't Generate Authentication Key");
                }
                app('mailhelper')->sendVerificationMailToUser($user, false);
            }
            return redirect('user/recover-password')->with('success', "Congratulations! your email is verified");
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function actionResetpassword($token)
    {
        $model = User::findByPasswordResetToken($token);
        if (!($model)) {
            return redirect('login')->with('error', "Token is expired");
        }
        $model->removeToken();
        $model->generateAuthKey();
        $model->last_password_change = date('Y-m-d H:i:s');
        if (!$model->update()) {
            return redirect()->back()->with('error', $model->getErrors()->all());
        }
        return redirect('login')->with('success', "Congratulations! your password has been changed");
    }
}
