<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Settings\Entities\Setting;
use Illuminate\Support\Facades\Auth;


class SettingsController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $settings = Setting::all();
        return view('settings::index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $settingVariable = Setting::getModuleOptions();
        return view('settings::add', compact('settingVariable'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'key' => 'required',
                'value' => 'required',
                'module' => 'required',
            ]
        );
        $setting = new Setting();
        $setting->module = $request->input('module');
        $setting->key = $request->input('key');
        $setting->value = $request->input('value');
        $setting->created_by_id = Auth::id();
        if ($setting->save()) {
            return redirect('/settings/')->with('success', 'settings has been saved succesfully');
        } else {
            return redirect('/settings/')->with('error', 'settings could not be saved');
        }
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $settingVariable = Setting::getModuleOptions();
        $edit = Setting::where('id', $id)->first();
        return view('settings::edit', compact('edit','settingVariable'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate(
                [
                    'key' => 'required',
                    'value' => 'required',
                    'module' => 'required',
                ]
            );
            $update = Setting::find($id);
            $update->key = $request->input('key');
            $update->value = $request->input('value');
            $update->module = $request->input('module');
            $update->update();
            if ($update) {
                return redirect('/settings/')->with('success', "Updated");
            } else {
                return redirect('/settings/')->with('error', "couldn't be updated");
            }
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $delete = Setting::where('id', $id);
        if ($delete->delete()) {
            return redirect('/settings/')->with('success', "Settings has been deleted");
        } else {
            return redirect('settings/')->with('error', "Settings couldn't be deleted");
        }
    }

    public function show($id)
    {
        $show = Setting::where('id', $id)->first();
        return view('settings::show', compact('show'));
    }
}
