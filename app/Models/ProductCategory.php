<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    /**
     * Mendefinisikan relasi One-to-Many ke Product.
     * Satu ProductCategory memiliki banyak Products.
     */
    public function product()
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }
}
