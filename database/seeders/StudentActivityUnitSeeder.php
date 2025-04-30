<?php

namespace Database\Seeders;

use App\Models\StudentActivityUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentActivityUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StudentActivityUnit::create([
            'name' => 'UKM 1',
            'abbreviation' => 'UKM 1',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        ]);
    }
}
