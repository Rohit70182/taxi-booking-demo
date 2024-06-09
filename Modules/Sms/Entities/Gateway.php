<?php

namespace Modules\Sms\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    protected $table = 'gateway';

    const STATE_NEW = 0;

    const STATE_ACTIVE = 1;

    const STATE_ARCHIVED = 2;

    const TWILIO = 0;



    public $appends = ['state', 'type'];

    public function getStateAttribute()
    {
        switch ($this->state_id) {
            case self::STATE_NEW:
                return "New";
                
            case self::STATE_ACTIVE:
                return "Active";
                break;
                
            case self::STATE_ARCHIVED:
                return "Archived";
                
                break;
            default:
                return "Not Define";
            
         }
            
        }

    public function getTypeAttribute(){
       switch ($this->type_id)
       {
           case self::TWILIO:
               return "Twilio";
           
       }
       
    }


    public function get_created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');

    }
}
