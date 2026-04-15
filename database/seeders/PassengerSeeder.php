<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Passenger;

class PassengerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dummyPassengers = [
            ['fname' => 'Alice', 'lname' => 'Williams', 'phone' => '555-0200', 'gender' => 'Female', 'status' => 'Active'],
            ['fname' => 'Bob', 'lname' => 'Brown', 'phone' => '555-0201', 'gender' => 'Male', 'status' => 'Active'],
            ['fname' => 'Charlie', 'lname' => 'Jones', 'phone' => '555-0202', 'gender' => 'Male', 'status' => 'inactive'],
            ['fname' => 'Diana', 'lname' => 'Miller', 'phone' => '555-0203', 'gender' => 'Female', 'status' => 'Active'],
            ['fname' => 'Ethan', 'lname' => 'Moore', 'phone' => '555-0204', 'gender' => 'Male', 'status' => 'Active'],
        ];

        foreach ($dummyPassengers as $index => $data) {
            Passenger::create([
                'unique_id' => '#PSG' . (1000 + $index),
                'first_name' => $data['fname'],
                'last_name' => $data['lname'],
                'email' => strtolower($data['fname'] . '.' . $data['lname']) . '@example.com',
                'password' => Hash::make('password123'),
                'phone' => $data['phone'],
                'gender' => $data['gender'],
                'avatar' => null,
                'status' => $data['status'],
            ]);
        }
    }
}
