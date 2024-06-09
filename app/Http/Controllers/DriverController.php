<?php

namespace App\Http\Controllers;

use App\Models\DriverTag;
use App\Models\DriverTeam;
use App\Models\Team;
use App\Models\TransportType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
    public function index()
    {
        $driver = User::where('role', User::ROLE_DRIVER)->get();
        return view('dashboard.driver.index', compact('driver'));
    }

    public function add()
    {
        $transport_type = TransportType::get();
        $driver_tag = DriverTag::get();
        $teams = Team::get();
        return view('dashboard.driver.add', compact('transport_type', 'driver_tag', 'teams'));
    }

    public function create(Request $req)
    {
        try {
            $validator = validator(
                $req->all(),
                [
                    'name' => 'required|string|max:20',
                    'email' => 'required|email|unique:users,email',
                    'contact_no' => 'required',
                    'password' => 'required',
                    'image'  => 'mimes:jpeg,png,jpg,svg,|max:2048',
                ]
            );
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }

            DB::beginTransaction();

            $user = new User();
            $user->name = $req->input('name');
            $user->contact_no = $req->input('contact_no');
            $user->driver_type = $req->input('driver_type');
            $user->transport_type = $req->input('transport_type');
            $user->driver_tag = $req->input('driver_tag');
            $user->email = $req->input('email');
            $user->role = User::ROLE_DRIVER;
            $user->password = Hash::make($req->password);

            if ($req->hasfile('image')) {
                $file = $req->file('image');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extenstion;
                $file->move('public/uploads', $filename);
                $user->image = $filename;
            }
           
            if ($user->save()) {
                $team = new DriverTeam();
                $team->team_id = $req->input('team_id');
                $team->driver_id = $user->id;
                $team->state_id = Team::STATE_ACTIVE;
                $team->created_by_id = Auth::user()->id;
                if (!$team->save()) {
                    DB::rollBack();
                }

                DB::commit();
                return redirect('/dashboard/driver')->with('success', "Saved successfully");
            } else {
                DB::rollBack();
                return redirect()->back()->with('error', "unexpected error occurred,Couldn't be saved");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function show($id)
    {
        $show = User::where('id', $id)->first();
        return view('dashboard.driver.show', compact('show'));
    }

    public function delete($id)
    {
        try {
            $user = User::where('id', $id)->first();
            if (!empty($user)) {
                $user->delete();
                return redirect('/dashboard/driver')->with('success', "Driver Deleted successfully");
            } else {
                return redirect()->back()->with('error', "Driver not found");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
