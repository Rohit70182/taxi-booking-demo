<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Stripe\Entities\StripeSetting;
use Stripe;

class StripeController extends Controller
{
    public function stripe()
    {
        return view('stripe');
    }

    public function stripePost(Request $request)
    {
        $setting = new StripeSetting();
        if ($setting) {
            Stripe\Stripe::setApiKey($setting->secret_key);
            Stripe\Charge::create([
                "amount" => 100 * 100,
                "currency" => "INR",
                "source" => $request->stripeToken,
                "description" => "This is test payment",
            ]);

            Session::flash('success', 'Payment Successful!');

            return back();
        }
    }
}
