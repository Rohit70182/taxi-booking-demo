<?php

namespace App\Helpers;
use Request;
use App\Models\LogActivity as LogActivityModel;
use Illuminate\Support\Facades\Auth;

class LogActivity
{
    public static function addToLog($subject)
    {
    	$log['subject'] = $subject;
    	$log['url'] = Request::fullUrl();
    	$log['method'] = Request::method();
    	$log['ip'] = Request::ip();
    	$log['agent'] = Request::header('user-agent');
    	$log['user_id'] = auth::check() ? auth()->user()->id : LogActivityModel::ZERO;
    	LogActivityModel::create($log);
    }
    public static function logActivityLists()
    {
    	return LogActivityModel::latest()->paginate(10);
    }

	public static function generateRandomString($length = 20) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[random_int(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}
