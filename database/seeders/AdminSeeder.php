<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'lecturer_code' => '856363465765',
            'full_name' => 'Admin 1',
            'phone_number' => '08123456789',
            'gender' => 'male',
            'is_super_admin' => 1,
        ]);
    }
}
