<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\PassengerController;
use App\Http\Controllers\Web\DriverController;
use App\Http\Controllers\Web\BookingController;
use App\Http\Controllers\Web\VehicleController;
use App\Http\Controllers\Web\ReviewController;

// Root Redirect to Admin Login or Dashboard
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

// Authentication Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('admin.register');
    Route::post('/register', [AuthController::class, 'register'])->name('admin.register.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Password Reset Routes
    Route::get('/forgot', function () {
        return view('admin.auth.forgot');
    })->name('admin.forgot');

    Route::get('/reset', [AuthController::class, 'showUpdatePassword'])->name('admin.password.reset');
    Route::post('/reset', [AuthController::class, 'updatePassword'])->name('admin.password.update');

    // Protected Admin Routes
    Route::middleware(['auth:admin', 'admin.active'])->group(function () {
        Route::middleware(['admin.module:Dashboard'])->group(function () {
            Route::get('/', function () {
                return view('admin.dashboard.index');
            })->name('admin.dashboard');

            Route::get('/dashboard', function () {
                return view('admin.dashboard.index');
            })->name('admin.dashboard.alias');
        });

        Route::get('/profile', function () {
            return view('admin.profile');
        })->name('admin.profile');

        Route::middleware(['admin.module:Analytics/Stats'])->get('/analytics', function () {
            return view('admin.analytics.index');
        })->name('admin.analytics.index');

        Route::middleware(['admin.module:Passenger Management'])->group(function () {
            Route::get('/passenger-management', [PassengerController::class, 'index'])->name('admin.passenger.management');
            Route::get('/passenger-management/create', [PassengerController::class, 'create'])->name('admin.passenger.create');
            Route::post('/passenger-management/store', [PassengerController::class, 'store'])->name('admin.passenger.store');
            Route::get('/passenger-management/detail/{id}', [PassengerController::class, 'show'])->name('admin.passenger.detail');
            Route::get('/passenger-management/edit/{id}', [PassengerController::class, 'edit'])->name('admin.passenger.edit');
            Route::put('/passenger-management/update/{id}', [PassengerController::class, 'update'])->name('admin.passenger.update');
            Route::delete('/passenger-management/delete/{id}', [PassengerController::class, 'destroy'])->name('admin.passenger.delete');
            Route::patch('/passenger-management/status/{id}', [PassengerController::class, 'toggleStatus'])->name('admin.passenger.toggleStatus');
        });

        Route::middleware(['admin.module:Booking Management'])->group(function () {
            Route::get('/booking-management', [BookingController::class, 'index'])->name('admin.booking.management');
            Route::get('/booking-management/create', [BookingController::class, 'create'])->name('admin.booking.create');
            Route::post('/booking-management/store', [BookingController::class, 'store'])->name('admin.booking.store');
            Route::get('/booking-management/detail/{id}', [BookingController::class, 'show'])->name('admin.booking.detail');
        });

        Route::middleware(['admin.module:Reviews & Ratings'])->group(function () {
            Route::get('/reviews-ratings', [ReviewController::class, 'index'])->name('admin.reviews.ratings');
            Route::post('/reviews-ratings/store', [ReviewController::class, 'store'])->name('admin.reviews.store');
            Route::delete('/reviews-ratings/{id}', [ReviewController::class, 'destroy'])->name('admin.reviews.destroy');
        });

        Route::middleware(['admin.module:Payment Management'])->get('/drivers-payouts', function () {
            return view('admin.payouts.index');
        })->name('admin.payouts.drivers');

        Route::middleware(['admin.module:Commission Management'])->get('/commission-management', function () {
            return view('admin.commission.index');
        })->name('admin.commission.index');

        Route::middleware(['admin.module:Fare Management'])->get('/fare-management', function () {
            return view('admin.fare.index');
        })->name('admin.fare.management');

        // Support Tickets
        Route::middleware(['admin.module:Support Ticket'])->group(function () {
            Route::group(['prefix' => 'support-tickets', 'as' => 'admin.support.'], function () {
                Route::get('/', function () {
                    return view('admin.support.complaints.index');
                })->name('complaints.index');

                Route::get('/{id}', function ($id) {
                    return view('admin.support.complaints.detail', compact('id'));
                })->name('complaints.detail');
            });
        });

        Route::middleware(['admin.module:Notifications'])->group(function () {
            Route::get('/alerts', function () {
                return view('admin.alerts.index');
            })->name('admin.alerts.index');

            Route::get('/alerts/send', function () {
                return view('admin.alerts.send');
            })->name('admin.alerts.send');
        });

        Route::middleware(['admin.module:CMS management'])->get('/cms-management', function () {
            return view('admin.cms.index');
        })->name('admin.cms.index');

        Route::middleware(['admin.module:Admin Roles'])->group(function () {
            Route::get('/roles', [AdminController::class, 'index'])->name('admin.roles.index');
            Route::get('/roles/create', [AdminController::class, 'create'])->name('admin.roles.create');
            Route::post('/roles/store', [AdminController::class, 'store'])->name('admin.roles.store');
            Route::get('/roles/edit/{id}', [AdminController::class, 'edit'])->name('admin.roles.edit');
            Route::post('/roles/update/{id}', [AdminController::class, 'update'])->name('admin.roles.update');
            Route::delete('/roles/delete/{id}', [AdminController::class, 'destroy'])->name('admin.roles.destroy');
            Route::get('/roles/delete/{id}', [AdminController::class, 'destroy'])->name('admin.roles.destroy.get');
        });

        Route::middleware(['admin.module:Driver Management'])->group(function () {
            Route::group(['prefix' => 'driver-management', 'as' => 'admin.drivers.'], function () {
                Route::get('/directory', [DriverController::class, 'index'])->name('directory');
                Route::get('/create', [DriverController::class, 'create'])->name('create');
                Route::post('/store', [DriverController::class, 'store'])->name('store');
                Route::get('/view/{id}', [DriverController::class, 'show'])->name('view');
                Route::get('/edit/{id}', [DriverController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [DriverController::class, 'update'])->name('update');
                Route::patch('/status/{id}', [DriverController::class, 'toggleStatus'])->name('toggleStatus');
                Route::delete('/delete/{id}', [DriverController::class, 'destroy'])->name('delete');

                Route::get('/requests', function () {
                    return view('admin.drivers.requests');
                })->name('requests');
                Route::get('/active/view/{id}', [DriverController::class, 'show'])->name('active.view');
            });
        });

        Route::middleware(['admin.module:Promo code Management'])->group(function () {
            Route::get('/promo-management', function () {
                return view('admin.promo.index');
            })->name('admin.promo.index');

            Route::get('/promo-management/detail', function () {
                return view('admin.promo.detail');
            })->name('admin.promo.detail');
        });

        // Vehicle Management
        Route::get('/vehicle-management', [VehicleController::class, 'index'])->name('admin.vehicle.management');
        Route::get('/vehicle-management/create', [VehicleController::class, 'create'])->name('admin.vehicle.create');
        Route::post('/vehicle-management/store', [VehicleController::class, 'store'])->name('admin.vehicle.store');
        Route::get('/vehicle-management/edit/{id}', [VehicleController::class, 'edit'])->name('admin.vehicle.edit');
        Route::post('/vehicle-management/update/{id}', [VehicleController::class, 'update'])->name('admin.vehicle.update');
        Route::get('/vehicle-management/delete/{id}', [VehicleController::class, 'destroy'])->name('admin.vehicle.delete');
    });
});
