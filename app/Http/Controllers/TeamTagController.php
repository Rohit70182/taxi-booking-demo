<?php

namespace App\Http\Controllers;

use App\Models\TeamTag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TeamTagController extends Controller
{
    public function index()
    {
        $tags = TeamTag::where('state_id', TeamTag::STATE_ACTIVE)->paginate(8);
        return view('dashboard.team-tag.index', compact('tags'));
    }

    public function add()
    {
        return view('dashboard.team-tag.add');
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

            $team_tag = new TeamTag();
            $team_tag->title = $request->input('title');
            $team_tag->state_id = TeamTag::STATE_ACTIVE;
            $team_tag->created_by_id = Auth::user()->id;

            if ($team_tag->save()) {
                return redirect('/dashboard/team-tag')->with('success', "Saved successfully");
            } else {
                return redirect()->back()->with('error', "unexpected error occurred,Couldn't be saved");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function show($id)
    {
        $tag = TeamTag::where('id', $id)->first();
        return view('dashboard.team-tag.show', compact('tag'));
    }

    public function delete($id)
    {
        try {
            $tag = TeamTag::where('id', $id)->first();

            if (!empty($tag)) {
                $tag->delete();
                return redirect('/dashboard/team-tag')->with('success', "Team Tag Deleted successfully");
            } else {
                return redirect()->back()->with('error', "Team tag not found");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $GetData = TeamTag::find($id);
        return view('dashboard.team-tag.update', compact('GetData'));
    }

    public function update(Request $request, $id)
    {
        try {
            $tag = TeamTag::find($id);
            $tag->title = $request->title;
            $tag->state_id = TeamTag::STATE_ACTIVE;
            $tag->created_by_id = Auth::user()->id;

            if ($tag->update()) {
                return redirect('/dashboard/team-tag')->with('success', "Data has been Updated Successfully");
            } else {
                return redirect()->back()->with('error', "Error Occurred,Data Couldn't be Updated.");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
}
