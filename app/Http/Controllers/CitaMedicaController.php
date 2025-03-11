<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita_Medica;
use App\Models\User; // Para seleccionar pacientes y médicos

class CitaMedicaController extends Controller
{
    public function index()
    {
        $citas = Cita_Medica::with(['paciente', 'medico'])->get();
        return view('citas.index', compact('citas'));
    }

    public function show(Cita_Medica $citaMedica)
    {
        return view('citas.show', compact('citaMedica'));
    }

    public function create()
    {
        $pacientes = User::where('role', 'paciente')->get();
        $medicos = User::where('role', 'medico')->get();

        return view('citas.create', compact('pacientes', 'medicos'));
    }

    public function edit(Cita_Medica $citaMedica)
    {
        $pacientes = User::where('role', 'paciente')->get();
        $medicos = User::where('role', 'medico')->get();

        return view('citas.edit', compact('citaMedica', 'pacientes', 'medicos'));
    }
}
