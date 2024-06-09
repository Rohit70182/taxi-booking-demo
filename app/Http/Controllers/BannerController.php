<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $banner = Banner::get();
        return view('banners.index', compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $typeAttribute = Banner::getTypeOptions();
        return view('banners.form', compact('typeAttribute'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            $validator = validator(
                $request->all(),
                [
                    'title' => 'required|string|max:20',
                    'banner_file'  => 'mimes:jpeg,png,jpg,svg,|max:2048'
                ]
            );
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            if ($request->id) {
                $banner = Banner::where('id', $request->id)->first();
            } else {
                $banner = new Banner();
            }
            $banner->title = $request->title;
            $banner->description = $request->description;
            if ($request->hasfile('banner_file')) {
                $file = $request->file('banner_file');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extenstion;
                $file->move('public/uploads', $filename);
                $banner->banner_file = $filename;
            } else {
                $banner->banner_file = $banner->banner_file;
            }
            $banner->state_id = Banner::STATE_ACTIVE;
            $banner->type_id = $request->type_id;
            $banner->created_by_id = Auth::user()->id;
            if ($banner->save()) {
                return redirect('/banners')->with('success', __('Banner has been saved succesfully'));
            } else {
                return redirect()->back()->with('error', __('Banner could not be saved'));
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
        $banner = Banner::find($id);
        if (!empty($banner)) {
            return view('banners.view', compact('banner'));
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
        $banner = Banner::find($id);
        $typeAttribute = Banner::getTypeOptions();
        if (!empty($banner)) {
            return view('banners.form', compact('banner', 'typeAttribute'));
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
        $banner = Banner::where('id', $id)->first();
        if (!empty($banner)) {
            $banner->delete();
            return redirect()->back()->with('success', 'Deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Data not found');
        }
    }
}
