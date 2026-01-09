<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Exception;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $category = ProductCategory::with('product.variant')->get();

            return response()->json([
                'message' => 'Kategori produk berhasil ditampilkan !!!',
                'data' => $category
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal menampilkan kategori produk !!!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return response()->json([
                'message' => 'Route Create Siap Digunakan !!!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Terjadi Kesalahan pada create: '
                    . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255|unique:product_categories,nama',
                'deskripsi' => 'nullable|string'
            ]);

            $category = ProductCategory::create($validatedData);
            return response()->json([
                'message' => 'Kategori produk berhasil ditambahkan !!!',
                'data' => $category
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan kategori produk !!!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $category = ProductCategory::with('product.variant')->findOrFail($id);

            return response()->json([
                'message' => 'Kategori produk pilihan berhasil ditampilkan !!!',
                'data' => $category
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal menampilkan kategori produk !!!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $category = ProductCategory::findOrFail($id);

            return response()->json([
                'message' => 'Route edit siap digunakan !!!',
                'data' => $category
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada edit: '
                    . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $category = ProductCategory::findOrFail($id);

            $validatedData = $request->validate([
                'nama' => 'nullable|string|max:255|unique:product_categories,nama,' . $id,
                'deskripsi' => 'nullable|string'
            ]);

            $category->update($validatedData);
            return response()->json([
                'message' => 'Kategori produk berhasil diupdate !!!',
                'data' => $category
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui kategori produk !!!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = ProductCategory::findOrFail($id);

            $category->delete();
            return response()->json([
                'message' => 'Kategori produk berhasil dihapus !!!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus kategori produk !!!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
