<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use App\Models\Promotion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PromotionController extends Controller
{
    public function index()
    {
        $promotion = Promotion::where('state_id', Promotion::STATE_ACTIVE)->paginate(8);

        return view('dashboard.promotion.index', compact('promotion'));
    }

    public function add()
    {
        $promoCode = PromoCode::get();

        return view('dashboard.promotion.add', compact('promoCode'));
    }

    public function create(Request $request)
    {
        try {
            $validator = validator(
                $request->all(),
                [
                    'code_id' => 'required',
                ]
            );

            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }

            $promotion = new Promotion();
            $promotion->code_id = $request->code_id;
            $promotion->description = $request->description;
            $promotion->state_id = Promotion::STATE_ACTIVE;
            $promotion->created_by_id = Auth::user()->id;
            $promotion->save();

            if ($promotion) {
                return redirect('/dashboard/promotion')->with('success', "Promotion saved successfully");
            } else {
                return redirect()->back()->with('error', "unexpected error occurred,Couldn't be saved");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function show($id)
    {
        $promotion = Promotion::where('id', $id)->first();
        return view('dashboard.promotion.show', compact('promotion'));
    }

    public function delete($id)
    {
        try {
            $promotion = Promotion::where('id', $id)->first();

            if (!empty($promotion)) {
                $promotion->delete();
                return redirect('/dashboard/promotion')->with('success', "Promotion Deleted successfully");
            } else {
                return redirect()->back()->with('error', "Promotion not found");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
