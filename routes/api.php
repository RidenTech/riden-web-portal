<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PassengerAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('passenger')->group(function () {
    // Public routes
    Route::post('/register', [PassengerAuthController::class, 'register']);
    Route::post('/login', [PassengerAuthController::class, 'login']);

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [PassengerAuthController::class, 'profile']);
        Route::get('/detail/{id}', [PassengerAuthController::class, 'profile']); // Reuse profile logic for detail
        Route::post('/profile/update', [PassengerAuthController::class, 'updateProfile']);
        Route::post('/password/update', [PassengerAuthController::class, 'updatePassword']);
        Route::patch('/status/{id}', [PassengerAuthController::class, 'toggleStatus']);
        Route::delete('/delete/{id}', [PassengerAuthController::class, 'destroy']);
        Route::post('/logout', [PassengerAuthController::class, 'logout']);
    });
});
