<?php

namespace Database\Factories;

use App\Models\DoctorSchedule;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorScheduleFactory extends Factory
{
    protected $model = DoctorSchedule::class;

    public function definition()
    {
        return [
            'id_user' => User::where('role', 'DOCTOR')->inRandomOrder()->first()->id_user, 
            'tanggal' => $this->faker->dateTimeThisYear()->format('Y-m-d'),
            'jam' => $this->faker->time('H:i'),
            'status' => $this->faker->randomElement(['AVAILABLE', 'UNAVAILABLE']),
        ];
    }
}
