<?php

namespace Modules\Catalog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CatalogCategory extends Model
{
    use HasFactory;

    const STATE_INACTIVE = 0;

    const STATE_ACTIVE = 1;

    protected $fillable = [];
    
    protected $table = 'catalog_category';
    
    protected static function newFactory()
    {
        return \Modules\Catalog\Database\factories\CatalogCategoryFactory::new();
    }
}
