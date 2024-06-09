<?php

use App\Models\UserDetail;
use Modules\Seo\Entities\Seo;
use Modules\Seo\Entities\Analytics;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Modules\Wallet\Entities\WalletDetail;

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
function get_seo()
{
    $uri = url()->current();
    $url = URL::to('/');
    $request_url = explode($url, $uri)[1];

    $seo = Seo::where('route', $request_url)->first();

    if (!empty($seo)) {
        return $seo;
    }
    return null;
}

function get_analytics()
{

    $analytics = Analytics::select('*')->first();

    if (!empty($analytics)) {
        return $analytics;
    }
    return null;
}


/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
function get_current_pic()
{
    $path =  asset('public/images/avatar.png');
    if (Auth::check() && Auth::User()->image) {
        $path = asset('public/uploads') . '/' . Auth::User()->image;
    }

    return $path;
}

/**
 * Get User Wallet Amount
 *
 * @param String $user_id
 * @return String $wallet_amount
 */
if (!function_exists('getUserWalletAmount')) {
	function getUserWalletAmount($user_id)
	{
		$wallet = WalletDetail::whereUserId($user_id)->first();
		$wallet_amount = $wallet->original_amount ?? "0";

		return strval($wallet_amount);
	}
}

function findNearestDrivers($latitude, $longitude, $radius = 400)
{

    $drivers = UserDetail::selectRaw("id, address, latitude, longitude ,
                        ( 6371000 * acos( cos( radians(?) ) *
                        cos( radians( latitude ) )
                        * cos( radians( longitude ) - radians(?)
                        ) + sin( radians(?) ) *
                        sin( radians( latitude ) ) )
                        ) AS distance", [$latitude, $longitude, $latitude])
        ->where('active', '=', 1)
        ->having("distance", "<", $radius)
        ->orderBy("distance", 'asc')
        ->offset(0)
        ->limit(20)
        ->get();

    return $drivers;
}
