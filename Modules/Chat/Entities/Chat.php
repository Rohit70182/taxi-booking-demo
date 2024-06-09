<?php

namespace Modules\Chat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
class Chat extends Model
{
    use HasFactory;

    const READ_NO = 0;
    const READ_YES = 1;
    
    protected $fillable = [];
    protected $table='chats'; 
    
    public function to_id(){

    }

    public function message() {
        return $this->belongsTo(User::class);
    }

     public function getTo()
    {
       return $this->belongsTo('App\Models\User', 'to_id' ,'id');
    }

    public function getFrom()
    {
        return $this->hasOne(User::class, [
            'id' => 'from_id'
        ]);
    }
}
