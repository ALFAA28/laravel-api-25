<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required',
        ]);
        $product = Product::create($validatedData);

        return response()->json($product, 201);
    }
}
