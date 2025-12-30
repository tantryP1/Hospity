<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Specialization;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name,
            'nik' => $this->faker->unique()->numerify('################'),
            'no_telp' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // Default password
            'role' => $this->faker->randomElement(['PATIENT', 'DOCTOR', 'ADMIN']), // Random role
        ];
    }

    public function patient()
    {
        return $this->state(fn (array $attributes) => ['role' => 'PATIENT']);
    }

    public function doctor()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'DOCTOR',
                'id_specialization' => Specialization::inRandomOrder()->first()->id_specialization, 
            ];
        });
    }

    public function admin()
    {
        return $this->state(fn (array $attributes) => ['role' => 'ADMIN']);
    }
}
