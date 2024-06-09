<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamTag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::where('state_id', Team::STATE_ACTIVE)->paginate(8);
        return view('dashboard.team.index', compact('teams'));
    }

    public function add()
    {
        $team_tags = TeamTag::get();
        return view('dashboard.team.add', compact('team_tags'));
    }

    public function create(Request $request)
    {
        try {

            $validator = validator(
                $request->all(),
                [
                    'team_name' => 'required',
                ]
            );

            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }

            $team = new Team();
            $team->team_name = $request->input('team_name');
            $team->frequency = $request->input('frequency');
            $team->team_strength = $request->input('team_strength');
            $team->team_tag_id = $request->input('team_tag_id');
            $team->state_id = Team::STATE_ACTIVE;
            $team->created_by_id = Auth::user()->id;

            if ($team->save()) {
                return redirect('/dashboard/team')->with('success', "Saved successfully");
            } else {
                return redirect()->back()->with('error', "unexpected error occurred,Couldn't be saved");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

}
