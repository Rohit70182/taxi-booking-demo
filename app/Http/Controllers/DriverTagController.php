<?php

namespace App\Http\Controllers;

use App\Models\DriverTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class DriverTagController extends Controller
{
    public function index()
    {
        $tags = DriverTag::where('state_id', DriverTag::STATE_ACTIVE)->paginate(8);
        return view('dashboard.driver-tag.index', compact('tags'));
    }

    public function add()
    {
        return view('dashboard.driver-tag.add');
    }

    public function create(Request $request)
    {

        try {

            $validator = validator(
                $request->all(),
                [
                    'title' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }

            $driver_tag = new DriverTag();
            $driver_tag->title = $request->input('title');
            $driver_tag->state_id = DriverTag::STATE_ACTIVE;
            $driver_tag->created_by_id = Auth::user()->id;

            if ($driver_tag->save()) {
                return redirect('/dashboard/driver-tag')->with('success', "Saved successfully");
            } else {
                return redirect()->back()->with('error', "unexpected error occurred,Couldn't be saved");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function show($id)
    {
        $tag = DriverTag::where('id', $id)->first();
        return view('dashboard.driver-tag.show', compact('tag'));
    }

    public function delete($id)
    {
        try {
            $tag = DriverTag::where('id', $id)->first();

            if (!empty($tag)) {
                $tag->delete();
                return redirect('/dashboard/driver-tag')->with('success', "Driver Tag Deleted successfully");
            } else {
                return redirect()->back()->with('error', "Driver tag not found");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $GetData = DriverTag::find($id);
        return view('dashboard.driver-tag.update', compact('GetData'));
    }

    public function update(Request $request, $id)
    {
        try {
            $tag = DriverTag::find($id);
            $tag->title = $request->title;
            $tag->state_id = DriverTag::STATE_ACTIVE;
            $tag->created_by_id = Auth::user()->id;

            if ($tag->update()) {
                return redirect('/dashboard/driver-tag')->with('success', "Data has been Updated Successfully");
            } else {
                return redirect()->back()->with('error', "Error Occurred,Data Couldn't be Updated.");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
}
