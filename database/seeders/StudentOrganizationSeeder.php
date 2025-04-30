<?php

namespace Database\Seeders;

use App\Models\StudentOrganization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentOrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StudentOrganization::create([
            'name' => 'Ormawa 1',
            'abbreviation' => 'ORM 1',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        ]);
    }
}
