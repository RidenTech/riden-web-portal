<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PassengerController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Passenger APIs (For Mobile App)
Route::prefix('passenger')->group(function () {
    // Public routes
    Route::post('/register', [PassengerController::class, 'register']);
    // TEMPORARY: Remote Database Fix (Run this once to create missing tables)
Route::get('/fix-database', function() {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        return response()->json(['status' => 'success', 'message' => 'Database migrated successfully!', 'output' => \Illuminate\Support\Facades\Artisan::output()]);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
});

Route::post('/login', [PassengerController::class, 'login']);

    // Protected routes 
    Route::middleware(['auth:sanctum', 'passenger.active'])->group(function () {
        Route::get('/profile', [PassengerController::class, 'profile']);
        Route::get('/detail/{id}', [PassengerController::class, 'profile']);
        Route::match(['POST', 'PUT', 'PATCH'], '/profile/update', [PassengerController::class, 'updateProfile']);
        Route::match(['POST', 'PUT', 'PATCH'], '/update/{id}', [PassengerController::class, 'updateProfile']);
        Route::post('/password/update', [PassengerController::class, 'updatePassword']);
        Route::patch('/status/{id}', [PassengerController::class, 'toggleStatus']);
        Route::delete('/delete/{id}', [PassengerController::class, 'destroy']);
        Route::post('/logout', [PassengerController::class, 'logout']);

        // Booking Management APIs
        Route::prefix('bookings')->group(function () {
            Route::get('/', [BookingController::class, 'index']);
            Route::post('/create', [BookingController::class, 'store']);
            Route::get('/{id}', [BookingController::class, 'show']);
            Route::post('/{id}/cancel', [BookingController::class, 'cancel']);
        });

        // Review APIs
        Route::prefix('reviews')->group(function () {
            Route::get('/', [App\Http\Controllers\Api\ReviewController::class, 'index']); // Get their own reviews or driver reviews
            Route::post('/store', [App\Http\Controllers\Api\ReviewController::class, 'store']); // Review a driver
        });

        // Support Ticket APIs
        Route::prefix('support')->group(function () {
            Route::get('/', [App\Http\Controllers\Api\SupportTicketController::class, 'index']);
            Route::post('/create', [App\Http\Controllers\Api\SupportTicketController::class, 'store']);
            Route::get('/{id}', [App\Http\Controllers\Api\SupportTicketController::class, 'show']);
        });
    });
});

// Admin APIs (For React Web Portal)
Route::prefix('admin')->group(function () {
    // Public routes
    Route::post('/login', [App\Http\Controllers\Api\AdminController::class, 'login']);
    Route::post('/register', [App\Http\Controllers\Api\AdminController::class, 'register']);

    // Protected routes
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/me', [App\Http\Controllers\Api\AdminController::class, 'me']);
        Route::post('/logout', [App\Http\Controllers\Api\AdminController::class, 'logout']);
        Route::post('/password/reset', [App\Http\Controllers\Api\AdminController::class, 'updatePassword']);

        // Dashboard & Analytics
        Route::get('/stats', [App\Http\Controllers\Api\AdminController::class, 'getStats']);
        Route::get('/analytics', [App\Http\Controllers\Api\AdminController::class, 'getAnalytics']);

        // Booking Management
        Route::prefix('bookings')->group(function () {
            Route::get('/', [App\Http\Controllers\Api\BookingController::class, 'adminIndex']);
            Route::get('/{id}', [App\Http\Controllers\Api\BookingController::class, 'adminShow']);
            Route::patch('/{id}/status', [App\Http\Controllers\Api\BookingController::class, 'updateStatus']);
        });

        // Passenger Management
        Route::prefix('passengers')->group(function () {
            Route::get('/', [App\Http\Controllers\Api\PassengerController::class, 'index']);
            Route::post('/', [App\Http\Controllers\Api\PassengerController::class, 'store']);
            Route::get('/{id}', [App\Http\Controllers\Api\PassengerController::class, 'show']);
            Route::patch('/{id}', [App\Http\Controllers\Api\PassengerController::class, 'update']);
            Route::patch('/{id}/status', [App\Http\Controllers\Api\PassengerController::class, 'toggleStatus']);
            Route::delete('/{id}', [App\Http\Controllers\Api\PassengerController::class, 'destroy']);
        });

        // Driver Management
        Route::prefix('drivers')->group(function () {
            Route::get('/', [App\Http\Controllers\Api\DriverController::class, 'index']);
            Route::post('/', [App\Http\Controllers\Api\DriverController::class, 'store']);
            Route::get('/{id}', [App\Http\Controllers\Api\DriverController::class, 'show']);
            Route::patch('/{id}', [App\Http\Controllers\Api\DriverController::class, 'update']);
            Route::patch('/{id}/status', [App\Http\Controllers\Api\DriverController::class, 'toggleStatus']);
            Route::delete('/{id}', [App\Http\Controllers\Api\DriverController::class, 'destroy']);
        });

        // Vehicle Management
        Route::prefix('vehicles')->group(function () {
            Route::get('/', [App\Http\Controllers\Api\VehicleController::class, 'index']);
            Route::post('/', [App\Http\Controllers\Api\VehicleController::class, 'store']);
            Route::get('/{id}', [App\Http\Controllers\Api\VehicleController::class, 'show']);
            Route::patch('/{id}', [App\Http\Controllers\Api\VehicleController::class, 'update']);
            Route::delete('/{id}', [App\Http\Controllers\Api\VehicleController::class, 'destroy']);
        });

        // Roles & Permissions
        Route::prefix('roles')->group(function () {
            Route::get('/', [App\Http\Controllers\Api\AdminController::class, 'getRoles']);
            Route::post('/', [App\Http\Controllers\Api\AdminController::class, 'storeRole']);
            Route::patch('/{id}', [App\Http\Controllers\Api\AdminController::class, 'updateRole']);
            Route::delete('/{id}', [App\Http\Controllers\Api\AdminController::class, 'destroyRole']);
        });

        // Support Ticket Management (Admin)
        Route::prefix('support')->group(function () {
            Route::get('/', [App\Http\Controllers\Api\SupportTicketController::class, 'index']); // Use index for listing all
            Route::get('/{id}', [App\Http\Controllers\Api\SupportTicketController::class, 'show']);
            Route::patch('/{id}/status', [App\Http\Controllers\Web\SupportController::class, 'updateStatus']); // Link to existing status logic
        });

        // Reviews & Ratings
        Route::prefix('reviews')->group(function () {
            Route::get('/', [App\Http\Controllers\Api\ReviewController::class, 'index']);
            Route::post('/', [App\Http\Controllers\Api\ReviewController::class, 'store']);
            Route::delete('/{id}', [App\Http\Controllers\Api\ReviewController::class, 'destroy']);
        });

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
            
            // Promo Management
            Route::prefix('promo')->group(function () {
                Route::get('/', [App\Http\Controllers\Api\AdminController::class, 'getPromos']);
                Route::get('/{id}', [App\Http\Controllers\Api\AdminController::class, 'getPromo']);
                Route::post('/', [App\Http\Controllers\Api\AdminController::class, 'storePromo']);
            });
        });
    });
});
