<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Buku & Penulis</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        h3 {
            text-align: center;
            color: #2c3e50;
        }
        .book-list {
            max-width: 800px;
            margin: 0 auto;
        }
        .book-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .book-title {
            font-size: 18px;
            font-weight: bold;
            color: #34495e;
        }
        .book-meta {
            font-size: 14px;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <h3>📚 Daftar Buku & Penulis</h3>
    <div class="book-list">
        @forelse ($books as $book)
            <div class="book-card">
                <div class="book-title">{{ $book->title }}</div>
                <div class="book-meta">
                    Tahun Terbit: {{ $book->published_year }} <br>
                    Genre: {{ $book->genre ?? 'Tidak diketahui' }} <br>
                    Penulis: {{ $book->author->name ?? 'Tidak diketahui' }} <br>
                    Tanggal Lahir: 
                    {{ optional($book->author)->birthdate 
                        ? \Carbon\Carbon::parse($book->author->birthdate)->format('Y-m-d') 
                        : '-' }}
                </div>
            </div>
        @empty
            <p>Tidak ada data buku tersedia.</p>
        @endforelse
    </div>
</body>
</html>