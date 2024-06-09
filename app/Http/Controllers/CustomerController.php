<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = User::where('role', User::ROLE_USER)->paginate(8);
        return view('dashboard.customer.index', compact('customer'));
    }

    public function add()
    {
        return view('dashboard.customer.add');
    }

    public function create(Request $req)
    {
        try {
            $validator = validator($req->all(),
                [
                'name' => 'required|string|max:20',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'image'  => 'mimes:jpeg,png,jpg,svg,|max:2048'
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            
            $user = new User();
            $user->name = $req->input('name');
            $user->email = $req->input('email');
            $user->role = User::ROLE_USER;
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
                    'description' => 'A new Customer has been added',
                    'model_id' => $user->id,
                    'model_type' => 'User',
                    'to_user_id' => User::ROLE_ADMIN,
                    'created_by_id' => $user->id,
                ]);
                if ($user) {
                    return redirect('/dashboard/customer')->with('success', "Saved successfully");
                } else {
                    return redirect()->back()->with('error', "unexpected error occurred,Couldn't be saved");
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function show($id)
    {
        $show = User::where('id', $id)->first();
        return view('dashboard.customer.show', compact('show'));
    }

    public function delete($id)
    {
        try {
            $user = User::where('id', $id)->first();

            if (!empty($user)) {
                $user->delete();
                return redirect('/dashboard/customer')->with('success', "Customer Deleted successfully");
            } else {
                return redirect()->back()->with('error', "Customers not found");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
