<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    const STATE_INACTIVE = 0;

    const STATE_ACTIVE = 1;

    protected $fillable = [
        'code',
        'description',
        'value',
        'max_uses',
        'max_uses_per_user',
        'start_date',
        'expiry_date',
        'state_id',
        'type_id',
        'created_by_id',
    ];
}
