<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop passengers.unique_id (drop index first for SQLite compatibility)
        try {
            Schema::table('passengers', function (Blueprint $table) {
                if (Schema::hasIndex('passengers', 'passengers_unique_id_unique')) {
                    $table->dropUnique('passengers_unique_id_unique');
                }
            });
        } catch (\Throwable $e) { /* index may not exist */ }

        try {
            Schema::table('passengers', function (Blueprint $table) {
                if (Schema::hasColumn('passengers', 'unique_id')) {
                    $table->dropColumn('unique_id');
                }
            });
        } catch (\Throwable $e) { /* column may not exist */ }

        // Drop drivers.unique_id
        try {
            Schema::table('drivers', function (Blueprint $table) {
                if (Schema::hasIndex('drivers', 'drivers_unique_id_unique')) {
                    $table->dropUnique('drivers_unique_id_unique');
                }
            });
        } catch (\Throwable $e) { /* index may not exist */ }

        try {
            Schema::table('drivers', function (Blueprint $table) {
                if (Schema::hasColumn('drivers', 'unique_id')) {
                    $table->dropColumn('unique_id');
                }
            });
        } catch (\Throwable $e) { /* column may not exist */ }

        // Drop bookings.booking_id
        try {
            Schema::table('bookings', function (Blueprint $table) {
                if (Schema::hasColumn('bookings', 'booking_id')) {
                    $table->dropColumn('booking_id');
                }
            });
        } catch (\Throwable $e) { /* column may not exist */ }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('passengers', function (Blueprint $table) {
            $table->string('unique_id')->nullable();
        });
        Schema::table('drivers', function (Blueprint $table) {
            $table->string('unique_id')->nullable();
        });
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('booking_id')->nullable();
        });
    }
};
