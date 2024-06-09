<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SmsController extends Controller
{

    /**
     * sms list view
     */
    public function index()
    {
        return view('dashboard.sms.list');
    }

    /**
     * sms form view
     */
    public function add()
    {
        return view('dashboard.sms.form');
    }

    /**
     * send send to a user
     */
    public function send(Request $request)
    {

        try {
            if (isset($request->number) && isset($request->message)) {
                $account_sid = env('TWILIO_SID');
                $account_token = env('TWILIO_TOKEN');
                $number = env('TWILIO_FROM');
                $code = 91;
                $to_number = (int)$request->number;

                $client = new Client($account_sid, $account_token);

                $client->messages->create(
                    '+' . $code . $to_number,
                    array(
                        'from' => $number,
                        'body' => $request->message
                    )
                );
                if ($client) {
                    return redirect()->back()->with('success', 'Send successfully');
                }
            } else {
                return redirect()->back()->with('error', 'data missing');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
}
