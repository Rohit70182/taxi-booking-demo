<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    use HasFactory;

    const STATE_ACTIVE = 1;

    const STATE_iNACTIVE = 0;

    protected $fillable = ['name', 'image', 'cost_per_km', 'cost_per_minute', 'max_seat_capacity', 'base_price'];
}
