<?php

namespace Database\Seeders;

use App\Models\DoctorSchedule;
use App\Models\Specialization;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Generate 10 PATIENT users
        $specializations = [
            ['specialization_name' => 'Cardiology'],
            ['specialization_name' => 'Neurology'],
            ['specialization_name' => 'Pediatrics'],
            ['specialization_name' => 'Orthopedics'],
            ['specialization_name' => 'Dermatology'],
        ];

        foreach ($specializations as $specialization) {
            Specialization::create($specialization);
        }
        
        User::factory()->count(30)->patient()->create();

        // Generate 10 DOCTOR users
        User::factory()->count(30)->doctor()->create();

        // Generate 10 ADMIN users
        User::factory()->count(30)->admin()->create();

        DoctorSchedule::factory()->count(100)->create();

    }
}
