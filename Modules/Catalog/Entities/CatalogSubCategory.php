<?php

namespace Modules\Catalog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CatalogSubCategory extends Model
{
    use HasFactory;

    const STATE_INACTIVE = 0;

    const STATE_ACTIVE = 1;

    protected $fillable = [];

    protected $table = 'catalog_subcategory';
    
    protected static function newFactory()
    {
        return \Modules\Catalog\Database\factories\CatalogSubCategoryFactory::new();
    }

    public function category()
    {
        return $this->hasOne(CatalogCategory::class,'id', 'category_id');
    }
}
