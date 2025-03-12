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
        // Obtener todas las consultas, doctores y usuarios
        $consultas = Consulta::all();
        $doctores = Doctor::all();
        $usersM = User::all();

        // Retornar la vista para crear una nueva cita médica
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
        // Validación de los datos recibidos
        $request->validate([
            'orden' => 'required|integer|between:0,255',
            'fecha_hora' => 'required|date',
            'hora_ini' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_ini',
            'doctor_id' => 'required|integer|exists:doctor,id',
            'consulta_id' => 'required|integer|exists:consulta,id',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        // Crear una nueva cita médica con los datos validados
        Cita_Medica::create([
            'orden' => $request->orden,
            'fecha_hora' => $request->fecha_hora,
            'hora_ini' => $request->hora_ini,
            'hora_fin' => $request->hora_fin,
            'doctor_id' => $request->doctor_id,
            'consulta_id' => $request->consulta_id,
            'user_id' => $request->user_id
        ]);

        // Redirigir a la vista del dashboard con un mensaje de éxito
        return redirect()->route('dashboard')->with('success', 'Consulta creada correctamente.');
    }

    /**
     * Método para mostrar el historial de citas médicas de un paciente.
     */
    public function historial()
{
    // Obtener el ID del usuario autenticado
    $userId = Auth::guard('web')->user()->id;

    //Obtener todas las citas médicas del usuario
    //Filtrar solo las citas futuras
    $citasPendientes = Cita_Medica::where('user_id', $userId)
        // Filtrar solo las citas futuras
        ->where('fecha_hora', '>', now())  
        //Asegurarse de cargar todas las relaciones necesarias
        ->with(['centroMedico', 'doctor', 'consulta']) 
        ->orderBy('fecha_hora', 'asc')  
        ->get();

    //Filtrar solo las citas pasadas
    $citasPasadas = Cita_Medica::where('user_id', $userId)
        //Filtrar solo las citas pasadas
        ->where('fecha_hora', '<', now())  
        //Asegurarse de cargar todas las relaciones necesarias
        ->with(['centroMedico', 'doctor', 'consulta'])  
        ->orderBy('fecha_hora', 'desc')  
        ->get();

    //Retornar la vista para mostrar el historial de citas médicas
    return view('citas.historial', compact('citasPendientes', 'citasPasadas'));
}

}
