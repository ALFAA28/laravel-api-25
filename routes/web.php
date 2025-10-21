<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', [WelcomeController::class, 'show']);
