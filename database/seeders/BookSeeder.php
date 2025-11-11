<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = Author::all();

        // Pastikan setiap penulis punya setidaknya 1 buku
        foreach ($authors as $author) {
            Book::factory()->count(2)->create([
                'author_id' => $author->id,
            ]);
        }

    }
}
