<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverTeam extends Model
{
    use HasFactory;

    const STATE_INACTIVE = 0;

    const STATE_ACTIVE = 1;

    protected $guarded = [];
    protected $table = 'driver_teams';
}
