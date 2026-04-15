<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\DriverDocument;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dummyDrivers = [
            ['fname' => 'John', 'lname' => 'Doe', 'phone' => '555-0100', 'gender' => 'Male'],
            ['fname' => 'Jane', 'lname' => 'Smith', 'phone' => '555-0101', 'gender' => 'Female'],
            ['fname' => 'Michael', 'lname' => 'Johnson', 'phone' => '555-0102', 'gender' => 'Male'],
            ['fname' => 'Emily', 'lname' => 'Davis', 'phone' => '555-0103', 'gender' => 'Female'],
            ['fname' => 'Daniel', 'lname' => 'Wilson', 'phone' => '555-0104', 'gender' => 'Male'],
        ];

        foreach ($dummyDrivers as $index => $data) {
            $driver = Driver::create([
                'unique_id' => '#DRV' . (1000 + $index),
                'first_name' => $data['fname'],
                'last_name' => $data['lname'],
                'email' => strtolower($data['fname'] . '.' . $data['lname']) . '@example.com',
                'phone' => $data['phone'],
                'gender' => $data['gender'],
                'avatar' => null,
                'status' => 'Active',
                'is_online' => ($index % 2 == 0),
            ]);

            Vehicle::create([
                'driver_id' => $driver->id,
                'model' => 'Toyota Camry',
                'year' => '2022',
                'color' => 'Silver',
                'license_plate' => 'ABC-' . (1000 + $index),
                'vehicle_type' => 'Sedan',
            ]);

            DriverDocument::create([
                'driver_id' => $driver->id,
                'document_name' => 'Driving License',
                'file_path' => 'dummy/license.pdf',
                'status' => 'Verified',
            ]);

            DriverDocument::create([
                'driver_id' => $driver->id,
                'document_name' => 'Vehicle Registration',
                'file_path' => 'dummy/registration.pdf',
                'status' => 'Verified',
            ]);
        }
    }
}
