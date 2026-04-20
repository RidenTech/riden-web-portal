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
    Route::middleware(['auth:sanctum', 'passenger.active'])->group(function () {
        Route::get('/profile', [PassengerAuthController::class, 'profile']);
        Route::get('/detail/{id}', [PassengerAuthController::class, 'profile']); // Reuse profile logic for detail
        Route::post('/profile/update', [PassengerAuthController::class, 'updateProfile']);
        Route::post('/update/{id}', [PassengerAuthController::class, 'updateProfile']); // Handle mobile app's direct ID route
        Route::post('/password/update', [PassengerAuthController::class, 'updatePassword']);
        Route::patch('/status/{id}', [PassengerAuthController::class, 'toggleStatus']);
        Route::delete('/delete/{id}', [PassengerAuthController::class, 'destroy']);
        Route::post('/logout', [PassengerAuthController::class, 'logout']);
    });

   Route::middleware(['auth:sanctum', 'admin.module:Passenger Management'])->group(function () {

        Route::get('/passenger-management', [PassengerManagementController::class, 'index']);
        Route::get('/passenger-management/create', [PassengerManagementController::class, 'create']);
        Route::post('/passenger-management/store', [PassengerManagementController::class, 'store']);
        Route::get('/passenger-management/detail/{id}', [PassengerManagementController::class, 'show']);
        Route::get('/passenger-management/edit/{id}', [PassengerManagementController::class, 'edit']);
        Route::put('/passenger-management/update/{id}', [PassengerManagementController::class, 'update']);
        Route::delete('/passenger-management/delete/{id}', [PassengerManagementController::class, 'destroy']);
        Route::patch('/passenger-management/status/{id}', [PassengerManagementController::class, 'toggleStatus']);
    
    });
});


