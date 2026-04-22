<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PassengerAuthController;
use App\Http\Controllers\Api\BookingApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Passenger APIs (For Mobile App)
Route::prefix('passenger')->group(function () {
    // Public routes
    Route::post('/register', [PassengerAuthController::class, 'register']);
    Route::post('/login', [PassengerAuthController::class, 'login']);

    // Protected routes 
    Route::middleware(['auth:sanctum', 'passenger.active'])->group(function () {
        Route::get('/profile', [PassengerAuthController::class, 'profile']);
        Route::get('/detail/{id}', [PassengerAuthController::class, 'profile']);
        Route::match(['POST', 'PUT', 'PATCH'], '/profile/update', [PassengerAuthController::class, 'updateProfile']);
        Route::match(['POST', 'PUT', 'PATCH'], '/update/{id}', [PassengerAuthController::class, 'updateProfile']);
        Route::post('/password/update', [PassengerAuthController::class, 'updatePassword']);
        Route::patch('/status/{id}', [PassengerAuthController::class, 'toggleStatus']);
        Route::delete('/delete/{id}', [PassengerAuthController::class, 'destroy']);
        Route::post('/logout', [PassengerAuthController::class, 'logout']);

        // Booking Management APIs
        Route::prefix('bookings')->group(function () {
            Route::get('/', [BookingApiController::class, 'index']);
            Route::post('/create', [BookingApiController::class, 'store']);
            Route::get('/{id}', [BookingApiController::class, 'show']);
            Route::post('/{id}/cancel', [BookingApiController::class, 'cancel']);
        });
    });
});

// Admin APIs (For React Web Portal)
Route::prefix('admin')->group(function () {
    // Public routes
    Route::post('/login', [App\Http\Controllers\Api\Admin\AdminAuthController::class, 'login']);

    // Protected routes
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/me', [App\Http\Controllers\Api\Admin\AdminAuthController::class, 'me']);
        Route::post('/logout', [App\Http\Controllers\Api\Admin\AdminAuthController::class, 'logout']);

        // Dashboard & Analytics
        Route::get('/stats', [App\Http\Controllers\Api\Admin\AdminDashboardApiController::class, 'getStats']);
        Route::get('/analytics', [App\Http\Controllers\Api\Admin\AdminDashboardApiController::class, 'getAnalytics']);

        // Booking Management
        Route::prefix('bookings')->group(function () {
            Route::get('/', [App\Http\Controllers\Api\Admin\BookingApiController::class, 'index']);
            Route::get('/{id}', [App\Http\Controllers\Api\Admin\BookingApiController::class, 'show']);
            Route::patch('/{id}/status', [App\Http\Controllers\Api\Admin\BookingApiController::class, 'updateStatus']);
        });

        // Passenger Management
        Route::prefix('passengers')->group(function () {
            Route::get('/', [App\Http\Controllers\Api\Admin\PassengerApiController::class, 'index']);
            Route::post('/', [App\Http\Controllers\Api\Admin\PassengerApiController::class, 'store']);
            Route::get('/{id}', [App\Http\Controllers\Api\Admin\PassengerApiController::class, 'show']);
            Route::patch('/{id}', [App\Http\Controllers\Api\Admin\PassengerApiController::class, 'update']);
            Route::patch('/{id}/status', [App\Http\Controllers\Api\Admin\PassengerApiController::class, 'toggleStatus']);
            Route::delete('/{id}', [App\Http\Controllers\Api\Admin\PassengerApiController::class, 'destroy']);
        });

        // Driver Management
        Route::prefix('drivers')->group(function () {
            Route::get('/', [App\Http\Controllers\Api\Admin\DriverApiController::class, 'index']);
            Route::post('/', [App\Http\Controllers\Api\Admin\DriverApiController::class, 'store']);
            Route::get('/{id}', [App\Http\Controllers\Api\Admin\DriverApiController::class, 'show']);
            Route::patch('/{id}', [App\Http\Controllers\Api\Admin\DriverApiController::class, 'update']);
            Route::patch('/{id}/status', [App\Http\Controllers\Api\Admin\DriverApiController::class, 'toggleStatus']);
            Route::delete('/{id}', [App\Http\Controllers\Api\Admin\DriverApiController::class, 'destroy']);
        });

        // Vehicle Management
        Route::prefix('vehicles')->group(function () {
            Route::get('/', [App\Http\Controllers\Api\Admin\VehicleApiController::class, 'index']);
            Route::post('/', [App\Http\Controllers\Api\Admin\VehicleApiController::class, 'store']);
            Route::get('/{id}', [App\Http\Controllers\Api\Admin\VehicleApiController::class, 'show']);
            Route::patch('/{id}', [App\Http\Controllers\Api\Admin\VehicleApiController::class, 'update']);
            Route::delete('/{id}', [App\Http\Controllers\Api\Admin\VehicleApiController::class, 'destroy']);
        });

        // Roles & Permissions
        Route::prefix('roles')->group(function () {
            Route::get('/', [App\Http\Controllers\Api\Admin\AdminRoleApiController::class, 'index']);
            Route::post('/', [App\Http\Controllers\Api\Admin\AdminRoleApiController::class, 'store']);
            Route::patch('/{id}', [App\Http\Controllers\Api\Admin\AdminRoleApiController::class, 'update']);
            Route::delete('/{id}', [App\Http\Controllers\Api\Admin\AdminRoleApiController::class, 'destroy']);
        });

        // Support Tickets
        Route::prefix('support')->group(function () {
            Route::get('/', [App\Http\Controllers\Api\Admin\AdminSupportApiController::class, 'index']);
            Route::get('/{id}', [App\Http\Controllers\Api\Admin\AdminSupportApiController::class, 'show']);
            Route::post('/{id}/reply', [App\Http\Controllers\Api\Admin\AdminSupportApiController::class, 'reply']);
        });

        // Reviews & Ratings
        Route::get('/reviews', function() { return response()->json(['status' => 'success', 'data' => []]); });

        // Notifications & Alerts
        Route::prefix('alerts')->group(function () {
            Route::get('/', function() { return response()->json(['status' => 'success', 'data' => []]); });
            Route::post('/send', function() { return response()->json(['status' => 'success', 'message' => 'Alert sent']); });
        });

        // Settings (Fare, Commission, CMS, Promo)
        Route::prefix('settings')->group(function () {
            Route::get('/fare', function() { return response()->json(['status' => 'success', 'data' => []]); });
            Route::get('/commission', function() { return response()->json(['status' => 'success', 'data' => []]); });
            Route::get('/cms', function() { return response()->json(['status' => 'success', 'data' => []]); });
            Route::get('/promo', function() { return response()->json(['status' => 'success', 'data' => []]); });
        });
    });
});
