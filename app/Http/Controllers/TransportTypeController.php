<?php

namespace App\Http\Controllers;

use App\Models\TransportType;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TransportTypeController extends Controller
{
    public function index()
    {
        $transport_type = TransportType::where('state_id', TransportType::STATE_ACTIVE)->paginate(8);
        return view('dashboard.transport-type.index', compact('transport_type'));
    }


    public function add()
    {
        return view('dashboard.transport-type.add');
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

            $transport_type = new TransportType();
            $transport_type->title = $request->input('title');
            $transport_type->state_id = TransportType::STATE_ACTIVE;
            $transport_type->created_by_id = Auth::user()->id;

            if ($transport_type->save()) {
                return redirect('/dashboard/transport-type')->with('success', "Saved successfully");
            } else {
                return redirect()->back()->with('error', "unexpected error occurred,Couldn't be saved");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }


    public function show($id)
    {
        $transport_type = TransportType::where('id', $id)->first();
        return view('dashboard.transport-type.show', compact('transport_type'));
    }

    public function delete($id)
    {
        try {
            $transport_type = TransportType::where('id', $id)->first();

            if (!empty($transport_type)) {
                $transport_type->delete();
                return redirect('/dashboard/transport-type')->with('success', "Transport Type Deleted successfully");
            } else {
                return redirect()->back()->with('error', "Transport type not found");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $GetData = TransportType::find($id);
        return view('dashboard.transport-type.update', compact('GetData'));
    }

    public function update(Request $request, $id)
    {
        try {
            $transport_type = TransportType::find($id);
            $transport_type->title = $request->title;
            $transport_type->state_id = TransportType::STATE_ACTIVE;
            $transport_type->created_by_id = Auth::user()->id;

            if ($transport_type->update()) {
                return redirect('/dashboard/transport-type')->with('success', "Data has been Updated Successfully");
            } else {
                return redirect()->back()->with('error', "Error Occurred,Data Couldn't be Updated.");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
}
