<?php

namespace Modules\Smtp\Providers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Modules\Smtp\Entities\Account;

class SmtpSetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {   
        //loading here
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if (Schema::hasTable('smtp_account')) {
            $mail = DB::table('smtp_account')
           ->where('state_id', Account::STATE_ACTIVE)
           ->first();
           if (!empty($mail)) //checking if table is not empty
           {
                
                $config = array(
                    'driver'     => $mail->title,
                    'host'       => $mail->server,
                    'port'       => $mail->port,
                    'encryption' => 'tls',
                    'username'   => $mail->email,
                    'password'   => $mail->password,
                    'sendmail'   => '/usr/sbin/sendmail -bs',
                    'from' => ['address' =>  $mail->email, 'name' => 'Admin'],
                    'pretend'    => false,
                );
                Config::set('mail', $config);
            }
        }
    }
}