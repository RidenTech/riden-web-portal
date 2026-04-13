<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default Admin
        Admin::updateOrCreate(
            ['email' => 'admin@riden.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'),
                'is_super' => true,
            ]
        );

        // Super Admin for Boss
        Admin::updateOrCreate(
            ['email' => 'haseeb302@gmail.com'],
            [
                'name' => 'Haseeb Super Admin',
                'password' => Hash::make('haseeb123'),
                'is_super' => true,
            ]
        );
    }
}
