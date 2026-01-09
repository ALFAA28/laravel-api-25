<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Exception;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $variant = ProductVariant::with('product')->get();

            return response()->json([
                'message' => 'Varian produk berhasil ditampilkan !!!',
                'data' => $variant
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal menampilkan varian produk !!!',
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
                'product_id' => 'required|exists:products,id',
                'nama' => 'required|string',
                'stok' => 'required|integer|min:0',
                'tambahan_harga' => 'nullable|numeric|min:0'
            ]);

            $variant = ProductVariant::create($validatedData);
            return response()->json([
                'message' => 'Varian produk berhasil ditambahkan !!!',
                'data' => $variant
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan varian produk !!!',
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
            $variant = ProductVariant::with('product')->findOrFail($id);

            return response()->json([
                'message' => 'Varian produk pilihan berhasil ditampilkan',
                'data' => $variant
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal menampilkan varian produk !!!',
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
            $variant = ProductVariant::with('product')->findOrFail($id);

            return response()->json([
                'message' => 'Route edit siap digunakan !!!',
                'data' => $variant
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
    public function update(Request $request, $id)
    {
        try {
            $variant = ProductVariant::findOrFail($id);

            $validatedData = $request->validate([
                'product_id' => 'exists:products,id',
                'nama' => 'string',
                'stok' => 'integer|min:0',
                'tambahan_harga' => 'nullable|numeric|min:0'
            ]);

            $variant->update($validatedData);
            return response()->json([
                'message' => 'Varian produk berhasil diupdate !!!',
                'data' => $variant
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui varian produk !!!',
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
            $variant = ProductVariant::findOrFail($id);

            $variant->delete();
            return response()->json([
                'message' => 'Varian produk berhasil dihapus !!!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus varian produk !!!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
