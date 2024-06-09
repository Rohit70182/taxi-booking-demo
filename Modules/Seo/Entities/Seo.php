<?php

namespace Modules\Seo\Entities;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $table = 'seo';

    const STATE_NEW = 0;

    const STATE_ACTIVE = 1;

    const STATE_DELETED = 2;

    public $appends = ['state'];

    public function getStateAttribute()
    {
        switch ($this->state_id) {
            case self::STATE_NEW:
                return "New";
                break;
            case self::STATE_ACTIVE:
                return "Active";
                break;
            case self::STATE_DELETED:
                return "Deleted";
                break;
            default:
                return "Not Define";
        }
    }
}
