<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita_Medica;
use App\Models\Consulta;
use App\Models\Doctor;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class CitaMedicaController extends Controller
{
    public function create()
    {
        $consultas = Consulta::all();
        $doctores = Doctor::all();
        $usersM = User::all();
        return view('citas.create', compact('consultas', 'doctores', 'usersM'));
    }

    public function edit($id)
    {
        //
    }

    /**
     * Guarda una nueva consulta en la base de datos (solo admin).
     */
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'orden' => 'required|integer|between:0,255', // `tinyint(3) UN` permite valores de 0 a 255
            'fecha_hora' => 'required|date', // Para el campo `datetime`
            'hora_ini' => 'required|date_format:H:i', // Para el campo `time`
            'hora_fin' => 'required|date_format:H:i|after:hora_ini', // `hora_fin` debe ser posterior a `hora_ini`
            'doctor_id' => 'required|integer|exists:doctor,id', // `bigint(20) UN`, también validamos si existe el doctor
            'consulta_id' => 'required|integer|exists:consulta,id', // `bigint(20) UN`, también validamos si existe la consulta
            'user_id' => 'required|integer|exists:users,id', // `bigint(20) UN`, también validamos si existe el usuario
        ]);

        // Crear nueva consulta
        Cita_Medica::create([
            'orden' => $request->orden,
            'fecha_hora' => $request->fecha_hora,
            'hora_ini' => $request->hora_ini,
            'hora_fin' => $request->hora_fin,
            'doctor_id' => $request->doctor_id,
            'consulta_id' => $request->consulta_id,
            'user_id' => $request->user_id
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('dashboard')->with('success', 'Consulta creada correctamente.');
    }
}
