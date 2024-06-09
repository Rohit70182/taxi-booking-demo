<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionBilling extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table='subscription_billings';
    protected static function newFactory()
    {
        return \Modules\Subscription\Database\factories\SubscriptionBillingFactory::new();
    }
}
