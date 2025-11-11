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

    public function show($id)
{
    $productCategory = ProductCategory::find($id);

    if (!$productCategory) {
        return response()->json(['message' => 'Product category not found'], 404);
    }

    return response()->json($productCategory);
}

public function update(Request $request, $id)
{
    $productCategory = ProductCategory::find($id);

    if (!$productCategory) {
        return response()->json(['message' => 'Product category not found'], 404);
    }

    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'description' => 'required',
    ]);

    $productCategory->update($validatedData);

    return response()->json($productCategory);
}

public function destroy($id)
{
    $productCategory = ProductCategory::find($id);

    if (!$productCategory) {
        return response()->json(['message' => 'Product category not found'], 404);
    }

    $productCategory->delete();

    return response()->json(['message' => 'Product category deleted successfully']);
}
}


