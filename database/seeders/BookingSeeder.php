<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Booking;
use App\Models\Passenger;
use App\Models\Driver;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $passengers = Passenger::all();
        $drivers = Driver::all();

        if ($passengers->isEmpty() || $drivers->isEmpty()) {
            return;
        }

        // Ongoing/Pending Bookings
        for ($i = 0; $i < 15; $i++) {
            Booking::create([
                'booking_id' => '#' . rand(10000, 99999),
                'passenger_id' => $passengers->random()->id,
                'driver_id' => rand(0, 1) ? $drivers->random()->id : null,
                'pickup_location' => 'Location ' . rand(1, 100),
                'dropoff_location' => 'Destination ' . rand(1, 100),
                'fare' => rand(10, 100),
                'status' => rand(0, 1) ? 'ongoing' : 'pending',
                'pickup_time' => now()->subMinutes(rand(5, 30)),
            ]);
        }

        // Previous Bookings
        for ($i = 0; $i < 20; $i++) {
            $status = rand(0, 5) > 1 ? 'completed' : 'cancelled';
            Booking::create([
                'booking_id' => '#' . rand(10000, 99999),
                'passenger_id' => $passengers->random()->id,
                'driver_id' => $drivers->random()->id,
                'pickup_location' => 'Old Location ' . rand(1, 100),
                'dropoff_location' => 'Old Destination ' . rand(1, 100),
                'fare' => rand(10, 100),
                'status' => $status,
                'pickup_time' => now()->subDays(rand(1, 30)),
                'completed_time' => $status === 'completed' ? now()->subDays(rand(1, 30))->addMinutes(rand(20, 60)) : null,
            ]);
        }
    }
}
