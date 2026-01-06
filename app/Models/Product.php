<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_category_id', 'name', 'description'];

    public function categories()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }
}
