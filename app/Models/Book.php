<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'published_year', 'author_id', 'genre'];
    // Relasi Many-to-One: Sebuah Book dimiliki oleh satu Author
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

}
