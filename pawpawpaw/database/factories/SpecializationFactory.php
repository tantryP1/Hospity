<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecializationFactory extends Factory
{
    public function definition()
    {
        return [
            'id_user' => User::where('role', 'DOCTOR')->inRandomOrder()->first()->id_user,
            'specialization_name' => $this->faker->randomElement([
                'Cardiology',
                'Dermatology',
                'Neurology',
                'Pediatrics',
                'Oncology',
                'Orthopedics',
                'Psychiatry',
                'Radiology',
                'Surgery',
                'General Medicine'
            ]),
        ];
    }
}
