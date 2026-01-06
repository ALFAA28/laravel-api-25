<?php

use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductVariantController;
use App\Http\Controllers\VendorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('/halo', function () {
        return 'Halo, Laravel';
    });
    
    Route::resource('vendors', VendorController::class);
    Route::resource('products', ProductController::class);
    Route::resource('categories', ProductCategoryController::class);
    Route::resource('variants', ProductVariantController::class);
});