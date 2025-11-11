<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $productCategories = ProductCategory::all();
        return response()->json($productCategories);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);
        $productCategory = ProductCategory::create($validatedData);

        return response()->json($productCategory, 201);
    }
}


