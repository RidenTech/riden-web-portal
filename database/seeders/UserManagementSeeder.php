<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Passenger;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;

class UserManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            ['first' => 'Wade', 'last' => 'Warren'],
            ['first' => 'Theresa', 'last' => 'Webb'],
            ['first' => 'Jacob', 'last' => 'Jones'],
            ['first' => 'Ralph', 'last' => 'Edwards'],
            ['first' => 'Bessie', 'last' => 'Cooper'],
            ['first' => 'Dianne', 'last' => 'Russell'],
            ['first' => 'Esther', 'last' => 'Howard'],
            ['first' => 'Jerome', 'last' => 'Bell'],
            ['first' => 'Darlene', 'last' => 'Robertson'],
            ['first' => 'Robert', 'last' => 'Fox'],
            ['first' => 'Cody', 'last' => 'Fisher'],
            ['first' => 'Kathryn', 'last' => 'Murphy'],
            ['first' => 'Ronald', 'last' => 'Richards'],
            ['first' => 'Savannah', 'last' => 'Nguyen'],
            ['first' => 'Floyd', 'last' => 'Miles'], // Duplicate as requested
            ['first' => 'Theresa', 'last' => 'Webb'], // Duplicate as requested
            ['first' => 'Floyd', 'last' => 'Miles'], // Second duplicate as requested
            ['first' => 'Albert', 'last' => 'Flores'],
            ['first' => 'Devon', 'last' => 'Lane'],
            ['first' => 'Marvin', 'last' => 'McKinney'],
        ];

        // Shuffle names to distribute
        shuffle($names);

        // Dummy Passengers (Half of the names)
        for ($i = 0; $i < 10; $i++) {
            Passenger::create([
                'unique_id' => 'PAS-' . rand(1000, 9999),
                'first_name' => $names[$i]['first'],
                'last_name' => $names[$i]['last'],
                'email' => strtolower($names[$i]['first']) . $i . '@example.com',
                'password' => Hash::make('password'),
                'phone' => '12345678' . $i,
                'status' => 'Active',
            ]);
        }

        // Dummy Drivers (Remaining names)
        for ($i = 10; $i < 20; $i++) {
            $driver = Driver::create([
                'unique_id' => 'DRV-' . rand(1000, 9999),
                'first_name' => $names[$i]['first'],
                'last_name' => $names[$i]['last'],
                'email' => strtolower($names[$i]['first']) . $i . '@example.com',
                'phone' => '87654321' . $i,
                'status' => 'Active',
                'is_online' => true,
            ]);

            Vehicle::create([
                'driver_id' => $driver->id,
                'model' => 'Toyota Prius',
                'year' => '2022',
                'color' => 'White',
                'license_plate' => 'ABC-' . rand(100, 999),
                'vehicle_type' => 'Car',
            ]);
        }
    }
}
