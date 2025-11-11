<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class author extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'birthdate'];

    // Relasi One-to-Many: Seorang Author memiliki banyak Book
    public function books()
    {
        return $this->hasMany(Book::class);
    }

}
