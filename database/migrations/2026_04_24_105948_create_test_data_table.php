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
        Schema::create('test_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id')->nullable()->index()->comment('Foreign key to drivers table');
            $table->unsignedBigInteger('vehicle_id')->nullable()->index()->comment('Foreign key to vehicles table');
            $table->decimal('longitude_driver', 11, 8)->nullable()->comment('Driver current longitude');
            $table->decimal('latitude_driver', 10, 8)->nullable()->comment('Driver current latitude');
            $table->decimal('rating', 3, 2)->default(0.00)->comment('Driver rating (e.g. 4.50)');
            $table->decimal('acceptance', 5, 2)->default(0.00)->comment('Driver acceptance rate percentage (e.g. 95.50)');
            $table->timestamps();

            // Note: Explicit foreign key constraints are omitted here for maximum flexibility 
            // in test data generation, but indexes are added for performance.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_data');
    }
};
