<?php

namespace Modules\Subscription\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Modules\Subscription\Entities\Subscriptionplan;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Subscriptionplan::all();
        return view('subscription::plan.index', compact('plans'));
    }

    public function add()
    {
        return view('subscription::plan.add');
    }

    public function store(Request $request)
    {
        try {
            $validator = validator(
                $request->all(),
                [
                    'title' => 'required',
                    'validity' => 'required',
                    'type' => 'required',
                    'price' => 'required',
                    'description' => 'required',
                ],

                [
                    'type.required' => 'You have to choose plan type'
                ]
            );
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }


            $Plan = new Subscriptionplan();
            $Plan->title = $request->input('title');
            $Plan->description = $request->input('description');
            $Plan->validity = $request->input('validity');
            $Plan->price = $request->input('price');
            $Plan->type = $request->input('type');
            $Plan->created_by_id = Auth::id();
            if ($Plan->save()) {
                return redirect('/subscription/plan/')->with('success', 'Plan has been saved succesfully');
            } else {
                return redirect('/subscrtiption/plan/')->with('error', 'Plan could not be saved');
            }
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $show = Subscriptionplan::where('id', $id)->first();
        return view('subscription::plan.show', compact('show'));
    }

    public function edit($id)
    {
        $edit = Subscriptionplan::where('id', $id)->first();
        return view('subscription::plan.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate(
                [
                    'title' => 'required',
                    'description' => 'required',
                    'validity' => 'required',
                    'price' => 'required',
                    'type' => 'required',

                ],
                [
                    'type.required' => 'you have to choose a plan'
                ]
            );
            $update = Subscriptionplan::find($id);
            $update->title = $request->input('title');
            $update->description = $request->input('description');
            $update->validity = $request->input('validity');
            $update->price = $request->input('price');
            $update->type = $request->input('type');
            $update->update();
            if ($update) {
                return redirect('/subscription/plan/')->with('status', "Plan has been Updated Successfully");
            } else {
                return redirect('/subscription/plan/')->with('status', "Plan couldn't be updated");
            }
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $delete = Subscriptionplan::where('id', $id);
        if ($delete->delete()) {
            return redirect('/subscription/plan/')->with('status', "Plan has been deleted Successfully");
        } else {
            return redirect('/subscription/plan/')->with('error', "Plan couldn't be deleted");
        }
    }
}
