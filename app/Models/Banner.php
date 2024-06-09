<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    const STATE_INACTIVE = 0;

    const STATE_ACTIVE = 1;

    const STATE_BANNED = 2;

    const STATE_DELETED = 3;

    const TYPE_WEB = 0;

    const TYPE_MOBILE = 1;
    
    protected $table='banners';

    public $appends = ['state', 'type'];
    protected static function boot()
    {
        parent::boot();
    }

    public static function getStateOptions()
    {
        return [
            self::STATE_INACTIVE => "New",
            self::STATE_ACTIVE => "Active",
            self::STATE_DELETED => "Deleted"
        ];
    }
    public function getStateAttribute()
    {
        $list = self::getStateOptions();
        return isset($list[$this->state_id]) ? $list[$this->state_id] : 'Not Defined';
    }

    public static function getTypeOptions($id = null)
    {
        return [
            self::TYPE_WEB => "Web",
            self::TYPE_MOBILE => "Mobile",
        ];
    }

    public function getTypeAttribute()
    {
        $list = self::getTypeOptions();
        return isset($list[$this->type_id]) ? $list[$this->type_id] : 'Not Defined';
    }

}
