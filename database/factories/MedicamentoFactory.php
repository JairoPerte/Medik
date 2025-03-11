<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Medicamento;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicamento>
 */
class MedicamentoFactory extends Factory
{
    protected $model = Medicamento::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(),
            'marca' => $this->faker->company(),
            'precio' => $this->faker->randomFloat(2, 5, 500),
            'cantidad' => $this->faker->randomElement(['10 tabletas', '20 tabletas', '100 ml', '250 mg', '500 mg']),
            'peso' => $this->faker->numberBetween(1, 500),
            'aplicacion' => $this->faker->randomElement(['Oral', 'Inyectable', 'Tópico', 'Sublingual']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
