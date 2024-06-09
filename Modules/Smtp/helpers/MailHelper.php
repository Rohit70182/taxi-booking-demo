<?php

namespace Modules\Smtp\helpers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\Smtp\Emails\RegistrationMail;
use Modules\Smtp\Entities\EmailQueue;
use Swift_TransportException;

class MailHelper
{
    public static function sendRegistrationMailToAdmin($user, $immediate = false)
    {
        //setting smtp data to env
        $allAdmins = User::findActive()->where(
            'role',
            User::ROLE_ADMIN
        )->chunk(10, function ($users) use ($user, $immediate) {
            foreach ($users as $admin) {
                if ($immediate && !empty($admin)) {
                    $email = $admin->email;
                    //Modify this data acc to your User model
                    try {
                        //first parameter here is user data and second is view name
                        Mail::to($email)->send(new RegistrationMail($user, 'registrationMailToAdmin'));
                        $state = EmailQueue::STATE_SENT;
                    } catch (Swift_TransportException $e) {
                        Log::error($e->getMessage());
                    }
                }
                EmailQueue::create([
                    'to_email' => $admin->email,
                    'from_email' => User::adminEmail(),
                    'subject' => 'New User Registerd Successfully',
                    'message' => 'New User Registerd Successfully',
                    'model_type' => User::class,
                    'state_id' => $state,
                ]);
            }
        });
    }


    public static function sendRegistrationMailToUser($user, $immediate = false)
    {
        $sub = "Welcome! You new account is ready " . config('app.name');
        $message = 'new User';
        $state = EmailQueue::STATE_PENDING;

        if ($immediate && !empty($user)) {
            $email = $user->email;
            //Modify this data acc to your User model
            try {
                //first parameter here is user data and second is view name
                Mail::to($email)->send(new RegistrationMail($user, 'registrationMailToUser'));
                $state = EmailQueue::STATE_SENT;
            } catch (Swift_TransportException $e) {
                Log::error($e->getMessage());
            }
        }

        if (!empty($user)) {
            EmailQueue::create([
                'to_email' => $user->email,
                'from_email' => User::adminEmail(),
                'subject' => 'New User Registerd Successfully',
                'message' => 'New User Registerd Successfully',
                'model_type' => User::class,
                'state_id' => $state,
            ]);
        }
    }

    public static function sendVerificationMailToUser($user, $immediate = false)
    {
        $sub = "Welcome! You new account is ready for " . config('app.name');
        $message = 'new User';
        $state = EmailQueue::STATE_PENDING;

        if ($immediate && !empty($user)) {
            $email = $user->email;
            //Modify this data acc to your User model
            try {
                //first parameter here is user data and second is view name
                Mail::to($email)->send(new RegistrationMail($user, 'verificationMailToUser'));
                $state = EmailQueue::STATE_SENT;
            } catch (Swift_TransportException $e) {
                Log::error($e->getMessage());
            }
        }
        if (!empty($user)) {
            EmailQueue::create([
                'to_email' => $user->email,
                'from_email' => User::adminEmail(),
                'subject' => $sub,
                'message' => $message,
                'model_type' => User::class,
                'state_id' => $state,
            ]);
        }
    }
}