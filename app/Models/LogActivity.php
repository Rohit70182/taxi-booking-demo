<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;

    const ZERO = 0;

    protected $fillable = [
    'subject', 'url', 'method', 'ip', 'agent', 'user_id'

    ];
}
