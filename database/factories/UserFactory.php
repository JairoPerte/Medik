<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Jairo',
            'apellido' => 'Pertegal',
            'email' => 'jpercar426@g.educaand.es',
            'password' => Hash::make('JairoPerte1!'),
            'nif' => '79252124G',
            'edad' => 19,
            'altura' => 185,
            'peso' => 87,
            'numtel' => "630 12 73 12",
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
