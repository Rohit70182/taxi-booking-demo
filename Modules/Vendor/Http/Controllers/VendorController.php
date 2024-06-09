<?php

namespace Modules\Vendor\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ImportVendor;
use App\Models\Notification;
use App\Models\User;

use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class VendorController extends Controller
{
    public function vendors()
    {
        $count = User::where('role', User::ROLE_VENDOR)->paginate(8);
        return view('dashboard.vendor.vendors', compact('count'));
    }

    public function show($id)
    {
        $show = User::where('id', $id)->first();
        return view('dashboard.vendor.show', compact('show'));
    }

    /*
     * Open Form 
    */
    public function add()
    {
        return view('dashboard.vendor.addvendor');
    }

     /*
     * Store Data
    */
    public function addVendor(Request $req)
    {
        try {
            $validator = validator($req->all(),
                [
                'name' => 'required|string|max:20',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'image'  => 'mimes:jpeg,png,jpg,svg,|max:2048'
            ]);

            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            
            $user = new User();
            $user->name = $req->input('name');
            $user->email = $req->input('email');
            $user->role = User::ROLE_VENDOR;
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
                    'description' => 'A new vendor has been added',
                    'model_id' => $user->id,
                    'model_type' => 'User',
                    'to_user_id' => User::ROLE_ADMIN,
                    'created_by_id' => $user->id,
                ]);
                if ($user) {
                    return redirect('/vendors')->with('success', "Saved successfully");
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
        return view('dashboard.vendor.update', compact('GetData'));
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
                return redirect('/vendors')->with('success', "Data has been Updated Successfully");
            } else {
                return redirect()->back()->with('error', "Error Occurred,Data Couldn't be Updated.");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
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
                return redirect('/vendors')->with('success', "Vendor Deleted successfully");
            } else {
                return redirect()->back()->with('error',"vendor not found");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function importView(){
        return view('dashboard.vendor.import');
    }

    public function import(Request $request){
        Excel::import(new ImportVendor, $request->file('file'));
        return redirect()->back()->with('success', 'Excel file successfully imported');
    }
}
