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
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_id')->unique(); // e.g., #34567
            $table->enum('user_type', ['driver', 'passenger'])->default('driver');
            
            // Flexible IDs
            $table->foreignId('driver_id')->nullable()->constrained('drivers')->onDelete('cascade');
            $table->foreignId('passenger_id')->nullable()->constrained('passengers')->onDelete('cascade');
            $table->foreignId('booking_id')->nullable()->constrained('bookings')->onDelete('set null');

            $table->string('complaint_type'); // Type 1, Type 2, etc.
            $table->string('subject')->nullable();
            $table->text('description'); // The "Text Box" content
            
            $table->enum('status', ['pending', 'resolved'])->default('pending');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};
