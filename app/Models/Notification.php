<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    const STATE_INACTIVE = 0;

    const STATE_ACTIVE = 1;

    const STATE_DELETED = 2;

    const TYPE_REQUEST_SEND = 0;

    const TYPE_REQUEST_ACCEPT = 1;

    const TYPE_REQUEST_ARRIVED = 2;

    const TYPE_REQUEST_COMPLETED = 3;

    const TYPE_REQUEST_STARTED = 6;

    const TYPE_REQUEST_CHAT = 5;

    const TYPE_REQUEST_CANCEL = 4;

    const TYPE_REQUEST_PAID = 7;

    protected $table = 'notifications';

    protected $fillable = ['title', 'description', 'model_id', 'is_read', 'state_id', 'type_id', 'model_type', 'to_user_id', 'created_by_id'];
}
