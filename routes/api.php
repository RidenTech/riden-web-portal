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
        Route::post('/logout', [PassengerAuthController::class, 'logout']);
    });

    Route::middleware(['admin.module:Passenger Management'])->group(function () {
        Route::get('/passenger-management', [PassengerManagementController::class, 'index'])->name('admin.passenger.management');
        Route::get('/passenger-management/create', [PassengerManagementController::class, 'create'])->name('admin.passenger.create');
        Route::post('/passenger-management/store', [PassengerManagementController::class, 'store'])->name('admin.passenger.store');
        Route::get('/passenger-management/detail/{id}', [PassengerManagementController::class, 'show'])->name('admin.passenger.detail');
        Route::get('/passenger-management/edit/{id}', [PassengerManagementController::class, 'edit'])->name('admin.passenger.edit');
        Route::put('/passenger-management/update/{id}', [PassengerManagementController::class, 'update'])->name('admin.passenger.update');
        Route::delete('/passenger-management/delete/{id}', [PassengerManagementController::class, 'destroy'])->name('admin.passenger.delete');
        Route::patch('/passenger-management/status/{id}', [PassengerManagementController::class, 'toggleStatus'])->name('admin.passenger.toggleStatus');
    });
});


