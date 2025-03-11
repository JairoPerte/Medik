<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nif' => $this->faker->unique()->bothify('########?#'),
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'edad' => $this->faker->numberBetween(25, 65),
            'numtel' => $this->faker->phoneNumber(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
