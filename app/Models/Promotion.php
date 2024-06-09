<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    
    const STATE_INACTIVE = 0;

    const STATE_ACTIVE = 1;

    protected $fillable = [
        'code_id',
        'description',
        'state_id',
        'type_id',
        'created_by_id',
    ];

    public function promo()
    {
        return $this->hasOne(PromoCode::class,'id', 'code_id');
    }
}
