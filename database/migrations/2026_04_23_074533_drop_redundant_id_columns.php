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
        Schema::table('passengers', function (Blueprint $table) {
            if (Schema::hasColumn('passengers', 'unique_id')) {
                $table->dropColumn('unique_id');
            }
        });
        Schema::table('drivers', function (Blueprint $table) {
            if (Schema::hasColumn('drivers', 'unique_id')) {
                $table->dropColumn('unique_id');
            }
        });
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'booking_id')) {
                $table->dropColumn('booking_id');
            }
        });
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
