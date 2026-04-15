<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\PassengerManagementController;
use App\Http\Controllers\Admin\DriverManagementController;
use App\Http\Controllers\Admin\BookingManagementController;

// Root Redirect to Admin Login or Dashboard
Route::get('/', function () {
    return redirect()->route('admin.login');
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
            Route::get('/passenger-management', [PassengerManagementController::class, 'index'])->name('admin.passenger.management');
            Route::get('/passenger-management/create', [PassengerManagementController::class, 'create'])->name('admin.passenger.create');
            Route::post('/passenger-management/store', [PassengerManagementController::class, 'store'])->name('admin.passenger.store');
            Route::get('/passenger-management/detail/{id}', [PassengerManagementController::class, 'show'])->name('admin.passenger.detail');
            Route::get('/passenger-management/edit/{id}', [PassengerManagementController::class, 'edit'])->name('admin.passenger.edit');
            Route::put('/passenger-management/update/{id}', [PassengerManagementController::class, 'update'])->name('admin.passenger.update');
            Route::delete('/passenger-management/delete/{id}', [PassengerManagementController::class, 'destroy'])->name('admin.passenger.delete');
            Route::patch('/passenger-management/status/{id}', [PassengerManagementController::class, 'toggleStatus'])->name('admin.passenger.toggleStatus');
        });

        Route::middleware(['admin.module:Booking Management'])->group(function () {
            Route::get('/booking-management', function () {
                return view('admin.booking.index');
            })->name('admin.booking.management');

            Route::get('/booking-management/detail/{id}', function ($id) {
                return view('admin.booking.detail', ['id' => $id]);
            })->name('admin.booking.detail');
            Route::get('/booking-management', [BookingManagementController::class, 'index'])->name('admin.booking.management');
            Route::get('/booking-management/detail/{id}', [BookingManagementController::class, 'show'])->name('admin.booking.detail');
        });

        Route::middleware(['admin.module:Reviews & Ratings'])->get('/reviews-ratings', function () {
            return view('admin.reviews.index');
        })->name('admin.reviews.ratings');

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
                    return view('admin.support.complaints.detail', ['id' => $id]);
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
            Route::get('/roles', [AdminRoleController::class, 'index'])->name('admin.roles.index');
            Route::get('/roles/create', [AdminRoleController::class, 'create'])->name('admin.roles.create');
            Route::post('/roles/store', [AdminRoleController::class, 'store'])->name('admin.roles.store');
            Route::get('/roles/edit/{id}', [AdminRoleController::class, 'edit'])->name('admin.roles.edit');
            Route::post('/roles/update/{id}', [AdminRoleController::class, 'update'])->name('admin.roles.update');
            Route::delete('/roles/delete/{id}', [AdminRoleController::class, 'destroy'])->name('admin.roles.destroy');
            Route::get('/roles/delete/{id}', [AdminRoleController::class, 'destroy'])->name('admin.roles.destroy.get');
        });

        Route::middleware(['admin.module:Driver Management'])->group(function () {
            Route::group(['prefix' => 'driver-management', 'as' => 'admin.drivers.'], function () {
                Route::get('/directory', [DriverManagementController::class, 'index'])->name('directory');
                Route::get('/create', [DriverManagementController::class, 'create'])->name('create');
                Route::post('/store', [DriverManagementController::class, 'store'])->name('store');
                Route::get('/view/{id}', [DriverManagementController::class, 'show'])->name('view');
                Route::get('/edit/{id}', [DriverManagementController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [DriverManagementController::class, 'update'])->name('update');
                Route::patch('/status/{id}', [DriverManagementController::class, 'toggleStatus'])->name('toggleStatus');
                Route::delete('/delete/{id}', [DriverManagementController::class, 'destroy'])->name('delete');
                
                // Keep these for now if they are used elsewhere, but point to logic later
                Route::get('/requests', function () {
                    return view('admin.drivers.requests');
                })->name('requests');
                Route::get('/active/view/{id}', [DriverManagementController::class, 'show'])->name('active.view');
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
    });
});





