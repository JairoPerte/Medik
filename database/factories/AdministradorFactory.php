<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Administrador>
 */
class AdministradorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Administrador',
            'apellido' => 'Total',
            'email' => 'administradorTotal@gmail.com',
            'password' => Hash::make('adminTotal123!'),
            'nif' => '11111111A',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
