<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{

    use HasFactory;
    const ANY = '*';
    const MODULE_BACKUP = 0;
    const MODULE_SUBSCRIPTION = 1;

    protected $fillable = [];
    protected $table = 'settings';
    protected static function newFactory()
    {
        return \Modules\Settings\Database\factories\SettingFactory::new();
    }
    public function getUser()
    {
        return $this->belongsTO('App\Models\User', 'created_by_id', 'id');
    }

    public static function getModuleOptions($id = null)
    {
        $list = array(
            self::ANY => "any",
            self::MODULE_BACKUP => "backup",
            self::MODULE_SUBSCRIPTION => "subscription",

        );
        if ($id === null)
            return $list;
        return isset($list[$id]) ? $list[$id] : 'Not Defined';
    }

    public function getModule()
    {
        $list = self::getModuleOptions();
        return isset($list[$this->module]) ? $list[$this->module] : 'Not Defined';
    }
}
