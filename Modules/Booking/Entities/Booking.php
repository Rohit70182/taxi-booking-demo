<?php

namespace Modules\Booking\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    const STATE_NEW = 0;

    const STATE_CANCELLED = 1;

    const STATE_INPROGRESS = 2;

    const STATE_ON_THE_WAY = 3;

    const STATE_ARRIVED = 4;

    const STATE_COMPLETED = 5;

    const STATE_ACCEPT = 6;

    const STATE_REJECT = 7;

    const STATE_DELETE = 8;

    const TYPE_DIRECT = 1;

    const TYPE_SCHEDULE = 2;


    protected $guarded = [];

    protected $table = 'booking';
}
