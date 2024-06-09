<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class VehicleTypeController extends Controller
{
    public function index()
    {
        $types = VehicleType::where('state_id', VehicleType::STATE_ACTIVE)->get();
        return view('dashboard.vehicle-type.index', compact('types'));
    }

    public function add()
    {
        return view('dashboard.vehicle-type.add');
    }

    public function create(Request $request)
    {
        try {
            $validator = validator(
                $request->all(),
                [
                    'name' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }

            $type = new VehicleType();
            $type->name = $request->input('name');
            $type->cost_per_km = $request->input('cost_per_km');
            $type->cost_per_minute = $request->input('cost_per_minute');
            $type->max_seat_capacity = $request->input('max_seat_capacity');
            $type->max_seat_capacity = $request->input('base_price');
            $type->state_id = VehicleType::STATE_ACTIVE;
            $type->created_by_id = Auth::user()->id;

            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extenstion;
                $file->move('public/uploads', $filename);
                $type->image = $filename;
            }

            if ($type->save()) {
                return redirect('/dashboard/vehicle-type')->with('success', "Saved successfully");
            } else {
                return redirect()->back()->with('error', "unexpected error occurred,Couldn't be saved");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function show($id)
    {
        $type = VehicleType::where('id', $id)->first();
        return view('dashboard.vehicle-type.show', compact('type'));
    }
}
