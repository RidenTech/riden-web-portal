<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Rename driver_reviews to reviews if not already renamed
        if (Schema::hasTable('driver_reviews') && !Schema::hasTable('reviews')) {
            Schema::rename('driver_reviews', 'reviews');
        }

        // 2. Add 'review_type' column to reviews if not exists
        if (!Schema::hasColumn('reviews', 'review_type')) {
            Schema::table('reviews', function (Blueprint $table) {
                $table->string('review_type')->default('driver')->after('id');
            });
        }

        // 3. Make driver_id and passenger_id nullable to support unified structure
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreignId('driver_id')->nullable()->change();
            $table->foreignId('passenger_id')->nullable()->change();
        });

        // 4. Migrate data from passenger_reviews to reviews
        if (Schema::hasTable('passenger_reviews')) {
            $passengerReviews = DB::table('passenger_reviews')->get();
            foreach ($passengerReviews as $pr) {
                DB::table('reviews')->insert([
                    'review_type' => 'passenger',
                    'passenger_id' => $pr->passenger_id,
                    'driver_id' => $pr->driver_id,
                    'reviewer_name' => $pr->reviewer_name,
                    'rating' => $pr->rating,
                    'review_text' => $pr->review_text,
                    'deleted_at' => $pr->deleted_at,
                    'created_at' => $pr->created_at,
                    'updated_at' => $pr->updated_at,
                ]);
            }

            // 5. Drop passenger_reviews table
            Schema::dropIfExists('passenger_reviews');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('reviews')) {
            Schema::rename('reviews', 'driver_reviews');
            Schema::table('driver_reviews', function (Blueprint $table) {
                $table->dropColumn('review_type');
            });
        }
    }
};
