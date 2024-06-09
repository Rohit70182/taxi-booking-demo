<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;
use Modules\Smtp\Entities\EmailQueue;
use Modules\Smtp\Entities\Account;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    const ROLE_ADMIN = 0;

    const EMAIL_VERIFIED = 1;

    const ROLE_USER = 1;

    const ROLE_MANAGER = 2;

    const ROLE_VENDOR = 3;

    const ROLE_DRIVER = 4;

    const STATE_INACTIVE = 0;

    const STATE_ACTIVE = 1;

    const STATE_COMPLETE = 2;

    const STATE_CANCELLED = 3;

    const STATE_BANNED = 2;

    const STATE_DELETED = 3;

    const TYPE_EMPLOYEE = 1;

    const TYPE_FREELANCER = 2;

    const MALE = 0;

    const FEMALE = 1;

    const OTHERS = 2;

    protected $table = 'users';
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function emergencyContacts()
    {
        return $this->hasMany(EmergencyContact::class);
    }
    public static function getRoleOptions($id = null)
    {
        $list = array(
            self::ROLE_ADMIN => "Admin",
            self::ROLE_MANAGER => "Manager",
            self::ROLE_USER => "User",
            self::ROLE_VENDOR => "Vendor",
            self::ROLE_DRIVER => "Driver",
        );
        if ($id === null)
            return $list;
        return isset($list[$id]) ? $list[$id] : 'Not Defined';
    }

    public function getRole()
    {
        $list = self::getRoleOptions();
        return isset($list[$this->role]) ? $list[$this->role] : 'Not Defined';
    }

    public function getDriverTypeName()
    {
        $list = array(
            self::TYPE_EMPLOYEE => "Employee",
            self::TYPE_FREELANCER => "Freelancer",
        );

        return isset($list[$this->driver_type]) ? $list[$this->driver_type] : '';
    }

    public function getTransportTypeName()
    {
        $transport = TransportType::find($this->transport_type);
        return isset($transport) ? $transport->title : '';
    }

    public function getDriverTagName()
    {
        $tag = DriverTag::find($this->driver_tag);
        return isset($tag) ? $tag->title : '';
    }

    public function getTeamName()
    {
        $driver = DriverTeam::where('driver_id', $this->id)->first();
        if ($driver) {
            $team = Team::find($driver->team_id);
            return isset($team) ? $team->team_name : '';
        } else {
            return 'Not Assigned';
        }
    }

    public function sendMailToAdmin()
    {
        $res = EmailQueue::create([
            'to' => $this->email,
            'from' => '',
            'subject' => 'Registration Email',
            'message' => 'Registration Done',
            'view' => 'email',
            'model' => [
                'user' => $this->user
            ], false
        ]);
    }

    public static function findActive($state_id = 1)
    {
        return self::where([
            'state_id' => $state_id
        ]);
    }
    public function message()
    {
        return $this->hasMany(Chat::class);
    }
    public function comments()
    {
        return $this->hasMany(\Modules\Comment\Entities\Comment::class, 'created_by_id', 'id');
    }

    public static function isUser()
    {
        $user = Auth::user();
        if ($user == null) {
            return false;
        }

        return ($user->isActive() && $user->role_id == User::ROLE_USER);
    }
    public static function adminEmail()
    {
        $user = self::where('role', User::ROLE_ADMIN)->first();
        if ($user != null) {
            return $user->email;
        }
    }
    public function removeToken()
    {
        $this->activation_key = null;
    }
    public function generatePasswordResetToken()
    {
        $this->activation_key = Str::random(16) . '_' . time();
    }
    public function generateAuthKey()
    {
        $this->activation_key = Str::random(16);
    }
    public function getVerified()
    {
        return  URL::route('user/confirm-email', $this->activation_key);
    }

    public static function isAdmin()
    {
        $user = Auth::user();
        if ($user == null) {
            return false;
        }

        return ($user->isActive() && $user->role_id == User::ROLE_ADMIN);
    }
    public function isActive()
    {
        return ($this->state_id == User::STATE_ACTIVE);
    }
    public static function findByUsername($param)
    {

        return self::where([
            ['email', '=',   $param],
        ])->orWhere([['contact_no', '=', $param]])->first();
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        $expire = config('auth.reset_token_timeout');
        if ($timestamp + $expire >= time()) {
            return false;
        } else {
            return true;
        }
    }

    public static function findByPasswordResetToken($token)
    {
        if (!self::isPasswordResetTokenValid($token)) {
            return false;
        }
        return self::where([
            'activation_key' => $token,
            'state_id' => self::STATE_ACTIVE
        ])->first();
    }
}
