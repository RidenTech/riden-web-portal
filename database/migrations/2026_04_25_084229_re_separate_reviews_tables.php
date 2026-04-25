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
        // 1. Create passenger_reviews table again
        Schema::create('passenger_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('passenger_id')->constrained('passengers')->onDelete('cascade');
            $table->foreignId('driver_id')->nullable()->constrained('drivers')->onDelete('cascade');
            $table->string('reviewer_name')->nullable();
            $table->decimal('rating', 2, 1);
            $table->text('review_text')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        // 2. Move passenger data back to passenger_reviews
        if (Schema::hasTable('reviews')) {
            $passengerData = DB::table('reviews')->where('review_type', 'passenger')->get();
            foreach ($passengerData as $pd) {
                DB::table('passenger_reviews')->insert([
                    'passenger_id' => $pd->passenger_id,
                    'driver_id' => $pd->driver_id,
                    'reviewer_name' => $pd->reviewer_name,
                    'rating' => $pd->rating,
                    'review_text' => $pd->review_text,
                    'deleted_at' => $pd->deleted_at,
                    'created_at' => $pd->created_at,
                    'updated_at' => $pd->updated_at,
                ]);
            }

            // 3. Remove passenger data from reviews
            DB::table('reviews')->where('review_type', 'passenger')->delete();

            // 4. Rename reviews back to driver_reviews and cleanup
            Schema::table('reviews', function (Blueprint $table) {
                $table->dropColumn('review_type');
            });
            Schema::rename('reviews', 'driver_reviews');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse logic if needed
    }
};
