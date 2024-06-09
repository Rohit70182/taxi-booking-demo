<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriptionplan extends Model
{
    use HasFactory;
    CONST PLAN_MONTHLY=0;
    CONST PLAN_YEARLY=1;

    protected $fillable = [];
    protected $table='subscriptionplans';
    protected static function newFactory()
    {
        return \Modules\Subscription\Database\factories\SubscriptionplanFactory::new();
    }
    
    public static function getPlanOptions($id = null)
    {
        $list = array(
            self::PLAN_MONTHLY => "monthly",
            self::PLAN_YEARLY => "yearly",

        );
        if ($id === null)
            return $list;
        return isset($list[$id]) ? $list[$id] : 'Not Defined';
    }

    public function getPlan()
    {
        $list = self::getPlanOptions();
        return isset($list[$this->type]) ? $list[$this->type] : 'Not Defined';
    }
}
