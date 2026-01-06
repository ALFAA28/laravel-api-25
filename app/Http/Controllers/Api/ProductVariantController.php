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
            $variant = ProductVariant::with(['products', 'categories'])->get();

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
                'product_category_id' => 'required|exists:product_categories,id',
                'product_id' => 'required|exists:products,id',
                'name' => 'required|string|unique:product_variants,name',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0'
            ]);

            $variant = ProductVariant::create($validatedData);
            return response()->json([
                'messsge' => 'Varian produk berhasil ditambahkan !!!',
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
            $variant = ProductVariant::with(['products', 'categories'])->findOrFail($id);

            if(!$variant) {
                return response()->json([
                    'message' => 'Varian produk belum dibuat !!!'
                ], 404);
            }

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
            $variant = ProductVariant::findOrFail($id);

            if(!$variant) {
                return response()->json([
                    'message' => 'Varian produk tidak ditemukan !!!'
                ], 404);
            }

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

            if(!$variant) {
                return response()->json([
                    'message' => 'Varian produk tidak ada !!!'
                ], 404);
            }

            $validatedData = $request->validate([
                'product_category_id' => 'exists:product_categories,id',
                'product_id' => 'exists:products,id',
                'name' => 'string|unique:product_variants,name',
                'price' => 'numeric|min:0',
                'stock' => 'integer|min:0'
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
            $variant = ProductVariant::findOrfail($id);

            if(!$variant) {
                return response()->json([
                    'message' => 'Varian produk tidak ada !!!'
                ], 404);
            }

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