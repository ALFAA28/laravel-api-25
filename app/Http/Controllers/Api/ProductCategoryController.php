<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException; // Import Exception untuk try-catch

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Mengambil semua kategori produk
        $productCategories = ProductCategory::all();

        // Cek jika koleksi kosong. Jika tidak ada data, kembalikan 404.
        if ($productCategories->isEmpty()) {
            return response()->json(['message' => 'Data kategori produk tidak ditemukan'], 404);
        }

        // Jika ada data, kembalikan data dengan status 200 OK
        return response()->json($productCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);
        
        // Membuat kategori produk baru
        $productCategory = ProductCategory::create($validatedData);

        // Mengembalikan kategori yang baru dibuat dengan status 201 Created
        return response()->json($productCategory, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            // Menggunakan findOrFail yang akan melempar ModelNotFoundException jika ID tidak ditemukan
            $productCategory = ProductCategory::findOrFail($id);

            // Mengembalikan data kategori produk
            return response()->json($productCategory);

        } catch (ModelNotFoundException $e) {
            // Menangkap ModelNotFoundException dan mengembalikan respons 404 kustom
            return response()->json(['message' => 'Data kategori produk tidak ditemukan'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            // Menggunakan findOrFail untuk memastikan kategori produk ada
            $productCategory = ProductCategory::findOrFail($id);

            // Validasi data input
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'description' => 'required',
            ]);

            // Memperbarui kategori produk
            $productCategory->update($validatedData);

            // Mengembalikan data kategori yang sudah diperbarui
            return response()->json($productCategory);

        } catch (ModelNotFoundException $e) {
            // Menangkap ModelNotFoundException dan mengembalikan respons 404 kustom
            return response()->json(['message' => 'Data kategori produk tidak ditemukan'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            // Menggunakan findOrFail untuk memastikan kategori produk ada
            $productCategory = ProductCategory::findOrFail($id);

            // Menghapus kategori produk
            $productCategory->delete();

            // Mengembalikan pesan sukses penghapusan
            return response()->json(['message' => 'Kategori produk berhasil dihapus']);

        } catch (ModelNotFoundException $e) {
            // Menangkap ModelNotFoundException dan mengembalikan respons 404 kustom
            return response()->json(['message' => 'Data kategori produk tidak ditemukan'], 404);
        }
    }
}