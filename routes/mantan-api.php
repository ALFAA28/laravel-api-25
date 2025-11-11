<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::Resource('products', ProductController::class);

    Route::resource('vendors', VendorController::class);

        Route::get('/hello', function () {
                return 'Hello World';
        });

});