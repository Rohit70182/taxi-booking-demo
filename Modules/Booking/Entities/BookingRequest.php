<?php

namespace Modules\Booking\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'booking_request';

}
