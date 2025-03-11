<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\Centro_Medico;
use App\Models\Consulta;
use App\Models\Doctor;
use App\Models\Medicamento;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Centro_Medico::factory(3)->create();
        Consulta::factory(10)->create();
        Doctor::factory(10)->create();
        Medicamento::factory(10)->create();

        Administrador::factory()->create();
        User::factory()->create();
    }
}
