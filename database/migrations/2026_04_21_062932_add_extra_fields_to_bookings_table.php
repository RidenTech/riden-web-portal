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
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('distance')->nullable()->after('dropoff_location');
            $table->string('duration')->nullable()->after('distance');
            $table->string('payment_method')->nullable()->after('fare');
            $table->string('payment_status')->default('pending')->after('payment_method');
            $table->string('card_last_four', 4)->nullable()->after('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['distance', 'duration', 'payment_method', 'payment_status', 'card_last_four']);
        });
    }
};
