<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_category_id',
        'nama',
        'harga',
        'deskripsi',
    ];

    /**
     * Mendefinisikan relasi BelongsTo ke ProductCategory.
     * Satu Product dimiliki oleh satu ProductCategory.
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    /**
     * Mendefinisikan relasi HasMany ke ProductVariant.
     * Satu Product memiliki banyak ProductVariants.
     */
    public function variant()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }
}
