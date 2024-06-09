<?php

namespace Modules\Seo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Seo\Entities\Seo;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $seo = Seo::all();
        return view('seo::manager.index', compact('seo'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('seo::manager.form');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            if ($request->id) {
                $seo = Seo::where('id', $request->id)->first();
            } else {
                $seo = new Seo();
            }
            $seo->route = $request->route;
            $seo->title = $request->title;
            $seo->keywords = $request->keywords;
            $seo->description = $request->description;
            $seo->data = $request->data;
            $seo->state_id = $request->status;
            if ($seo->save()) {
                return redirect('/seo/manager')->with('success', 'Manager has been saved succesfully');
            } else {
                return redirect()->back()->with('error', 'Manager could not be saved');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function view($id)
    {
        $seo = Seo::find($id);
        if (!empty($seo)) {
            return view('seo::manager.view', compact('seo'));
        } else {
            return redirect()->back()->with('error', 'Data not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $seo = Seo::find($id);
        if (!empty($seo)) {
            return view('seo::manager.form', compact('seo'));
        } else {
            return redirect()->back()->with('error', 'Data not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $seo = Seo::where('id', $id)->first();
        if (!empty($seo)) {
            $seo->delete();
            return redirect()->back()->with('success', 'Deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Data not found');
        }
    }
}
