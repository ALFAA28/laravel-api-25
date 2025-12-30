<?php

use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('v1')->group(function () {
    
    Route::resource('products-categories', ProductCategoryController::class);
    
    Route::Resource('products', ProductController::class);

    Route::resource('vendors', VendorController::class);

        Route::get('/hello', function () {
                return 'Hello World';
        });

        Route::get('/user', function (Request $request) {
            return $request->user();
        })->middleware('auth:sanctum');
});


