<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

//////////////////////////////// No login required ////////////////////////////

// Auth
Route::controller(AuthController::class)->middleware('throttle:60,1')->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

/////////////////////////////////// Login required /////////////////////////////////////////////////
Route::middleware(['auth:sanctum', 'throttle:30,1'])->group(function () {

    // Auth
    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout');
    });
});
