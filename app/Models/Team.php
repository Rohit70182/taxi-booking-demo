<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    use HasFactory;

    const STATE_INACTIVE = 0;

    const STATE_ACTIVE = 1;

    protected $fillable = [
        'team_name',
        'location',
        'latitude',
        'longitude',
        'frequency',
        'team_strength',
        'team_tag_id'
    ];

    protected static function boot(){
        parent::boot();
        static::deleted(function($team)
        {
            $team->driver()->delete();
        });
    }


    public function getTeamTagName()
    {
        $teamTag = TeamTag::find($this->team_tag_id);
        return isset($teamTag) ? $teamTag->title : '';
    }

    public function driver()
    {
        return $this->hasMany(DriverTeam::class);        
    }

}
