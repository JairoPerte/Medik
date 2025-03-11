<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita_Medica;
use Illuminate\Support\Facades\Auth; 

class CitaMedicaController extends Controller
{
    //Mostrar todas las citas (filtradas para el usuario autenticado)
    public function index()
    {
        //Obtener el ID del usuario autenticado
        $userId = Auth::guard('web')->id(); 

        //Obtener las citas pendientes (futuras)
        $citasPendientes = Cita_Medica::where('user_id', $userId)
            ->where('fecha', '>=', now())
            //Citas futuras ordenadas por fecha ascendente
            ->orderBy('fecha', 'asc') 
            ->get();

        //Obtener las citas pasadas (anteriores)
        $citasPasadas = Cita_Medica::where('user_id', $userId)
            ->where('fecha', '<', now())
            //Citas pasadas ordenadas por fecha descendente
            ->orderBy('fecha', 'desc') 
            ->get();

        return view('citas.historial', compact('citasPendientes', 'citasPasadas'));
    }

    //Mostrar una cita específica
    public function show(Cita_Medica $citaMedica)
    {
        return view('citas.show', compact('citaMedica'));
    }
}
