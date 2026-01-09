<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'nama',
        'stok',
        'tambahan_harga',
    ];

    /**
     * Mendefinisikan relasi BelongsTo ke Product.
     * Satu ProductVariant dimiliki oleh satu Product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
