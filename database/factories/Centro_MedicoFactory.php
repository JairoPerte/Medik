<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Centro_Medico;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Centro_Medico>
 */
class Centro_MedicoFactory extends Factory
{
    protected $model = Centro_Medico::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company(),
            'localidad' => $this->faker->city(),
            'calle' => $this->faker->streetAddress(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
