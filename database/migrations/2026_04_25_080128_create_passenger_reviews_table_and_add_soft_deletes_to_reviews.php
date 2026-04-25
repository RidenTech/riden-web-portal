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
        // 1. Create passenger_reviews table
        Schema::create('passenger_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('passenger_id')->constrained('passengers')->onDelete('cascade');
            $table->foreignId('driver_id')->nullable()->constrained('drivers')->onDelete('cascade');
            $table->string('reviewer_name')->nullable();
            $table->decimal('rating', 2, 1);
            $table->text('review_text')->nullable();
            $table->softDeletes(); // For Passenger reviews
            $table->timestamps();
        });

        // 2. Add softDeletes to existing driver_reviews
        Schema::table('driver_reviews', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('driver_reviews', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        
        Schema::dropIfExists('passenger_reviews');
    }
};
