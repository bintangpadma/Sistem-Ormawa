<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'admins_id' => 1,
            'username' => 'admin1',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('admin1'),
        ]);

        User::create([
            'admins_id' => 2,
            'username' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('admin2'),
        ]);
    }
}
