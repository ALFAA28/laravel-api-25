<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NamaController extends Controller
{
    Route::get('/posts';, [PostController::class, 'index']);
}
