<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromoCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PromoCodeController extends Controller
{
    public function index()
    {
        $promoCode = PromoCode::where('state_id', PromoCode::STATE_ACTIVE)->paginate(8);

        return view('dashboard.promo-code.index', compact('promoCode'));
    }

    public function add()
    {
        return view('dashboard.promo-code.add');
    }

    public function create(Request $request)
    {
        try {
            $validator = validator(
                $request->all(),
                [
                    'code' => 'required',
                ]
            );

            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }

            $promoCode = new PromoCode();
            $promoCode->code = $request->code;
            $promoCode->description = $request->description;
            $promoCode->value = $request->value;
            $promoCode->max_uses = $request->max_uses;
            $promoCode->max_uses_per_user = $request->max_uses_per_user;
            $promoCode->start_date = $request->start_date;
            $promoCode->expiry_date = $request->expiry_date;
            $promoCode->state_id = PromoCode::STATE_ACTIVE;
            $promoCode->created_by_id = Auth::user()->id;
            $promoCode->save();

            if ($promoCode) {
                return redirect('/dashboard/promo-code')->with('success', "PromoCode saved successfully");
            } else {
                return redirect()->back()->with('error', "unexpected error occurred,Couldn't be saved");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function show($id)
    {
        $promoCode = PromoCode::where('id', $id)->first();
        return view('dashboard.promo-code.show', compact('promoCode'));
    }

    public function edit($id)
    {
        $GetData = PromoCode::find($id);
        return view('dashboard.promo-code.update', compact('GetData'));
    }

    public function update(Request $request, $id)
    {
        try {
            $promoCode = PromoCode::find($id);
            $promoCode->code = $request->code;
            $promoCode->description = $request->description;
            $promoCode->value = $request->value;
            $promoCode->max_uses = $request->max_uses;
            $promoCode->max_uses_per_user = $request->max_uses_per_user;
            $promoCode->start_date = $request->start_date;
            $promoCode->expiry_date = $request->expiry_date;
            $promoCode->state_id = PromoCode::STATE_ACTIVE;
            $promoCode->created_by_id = Auth::user()->id;

            if ($promoCode->update()) {
                return redirect('/dashboard/promo-code')->with('success', "Data has been Updated Successfully");
            } else {
                return redirect()->back()->with('error', "Error Occurred,Data Couldn't be Updated.");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $promoCode = PromoCode::where('id', $id)->first();

            if (!empty($promoCode)) {
                $promoCode->delete();
                return redirect('/dashboard/promo-code')->with('success', "PromoCode Deleted successfully");
            } else {
                return redirect()->back()->with('error', "PromoCode not found");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
