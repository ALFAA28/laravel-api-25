<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $product = Product::with(['categories', 'variants'])->get();

            return response()->json([
                'message' => 'Produk berhasil ditampilkan !!!',
                'data' => $product
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal menampilkan produk !!!',
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
                'message' => 'Route create siap digunakan !!!'
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
                'product_category_id' => 'required|exists:product_categories,id',
                'name' => 'required|string|max:255',
                'description' => 'required|string'
            ]);

            $product = Product::create($validatedData);
            return response()->json([
                'message' => 'Produk berhasil ditambahkan !!!',
                'data' => $product
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan produk !!!',
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
            $product = Product::with(['categories', 'variants'])->findOrFail($id);
            
            return response()->json([
                'message' => 'Produk pilihan berhasil ditampilkan !!!',
                'data' => $product
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal menampilkan produk !!!',
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
            $product = Product::findOrFail($id);

            return response()->json([
                'message' => 'Route edit siap digunakan !!!',
                'data' => $product
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
            $product = Product::findOrFail($id);

            $validatedData = $request->validate([
                'product_category_id' => 'exists:product_categories,id',
                'name' => 'string|max:255',
                'description' => 'string'
            ]);

            $product->update($validatedData);
            return response()->json([
                'message' => 'Produk berhasil diupdate !!!',
                'data' => $product
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui produk !!!',
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
            $product = Product::findOrFail($id);

            $product->delete();
            return response()->json([
                'message' => 'Produk berhasil dihapus !!!'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'gagal menghapus produk !!!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
