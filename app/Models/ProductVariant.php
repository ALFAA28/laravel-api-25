<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = ['product_category_id', 'product_id', 'name', 'price', 'stock'];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function categories()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}
