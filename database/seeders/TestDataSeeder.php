<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch any existing driver and vehicle to associate with the test data (nullable if empty)
        $driverId = DB::table('drivers')->value('id');
        $vehicleId = DB::table('vehicles')->value('id');

        // Test coordinates provided by the user
        $locations = [
            [
                'latitude_driver' => 31.5147,
                'longitude_driver' => 74.2728, // ~5km radius reference point
                'rating' => 4.80,
                'acceptance' => 98.50,
            ],
            [
                'latitude_driver' => 31.5594,
                'longitude_driver' => 74.2730, // ~10km radius reference point
                'rating' => 4.50,
                'acceptance' => 92.00,
            ],
            [
                'latitude_driver' => 31.6047,
                'longitude_driver' => 74.2630, // ~15km radius reference point
                'rating' => 4.90,
                'acceptance' => 100.00,
            ]
        ];

        $testData = array_map(function ($location) use ($driverId, $vehicleId) {
            return [
                'driver_id' => $driverId,
                'vehicle_id' => $vehicleId,
                'latitude_driver' => $location['latitude_driver'],
                'longitude_driver' => $location['longitude_driver'],
                'rating' => $location['rating'],
                'acceptance' => $location['acceptance'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $locations);

        // Insert the test data into the test_data table
        DB::table('test_data')->insert($testData);
    }
}
