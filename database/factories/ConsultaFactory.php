<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Consulta;
use App\Models\Centro_Medico;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consulta>
 */
class ConsultaFactory extends Factory
{
    protected $model = Consulta::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'num' => $this->faker->numberBetween(1, 16),
            'tipoSala' => $this->faker->randomElement(['Pediatría', 'Cardiología', 'Radiología', 'Urgencias', 'Consulta General']),
            'centro_medico_id' => Centro_Medico::inRandomOrder()->first()->id ?? Centro_Medico::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
