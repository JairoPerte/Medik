<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\Centro_Medico;

class ConsultaController extends Controller
{
    /**
     * Muestra una lista de todas las consultas (accesible para todos los usuarios autenticados).
     */
    public function index()
    {
        $consultas = Consulta::all();
        return view('consultas.index', compact('consultas'));
    }

    /**
     * Muestra una consulta específica (accesible para todos los usuarios autenticados).
     */
    public function show($id)
    {
        $consulta = Consulta::with('centro_medico')->findOrFail($id);
        return view('consultas.show', compact('consulta'));
    }


    /**
     * Muestra el formulario para crear una nueva consulta (solo admin).
     */
    public function create()
    {
        $centrosMedicos = Centro_Medico::all(); // Obtener todos los centros médicos

        return view('consultas.create', compact('centrosMedicos')); // Enviar datos a la vista
    }

    /**
     * Guarda una nueva consulta en la base de datos (solo admin).
     */
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'num' => 'required|integer',
            'tipoSala' => 'required|string|max:255',
            'centro_medico_id' => 'required|exists:centro_medico,id'
        ]);

        // Crear nueva consulta
        Consulta::create([
            'num' => $request->num,
            'tipoSala' => $request->tipoSala,
            'centro_medico_id' => $request->centro_medico_id
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('consultas.index')->with('success', 'Consulta creada correctamente.');
    }


    /**
     * Muestra el formulario para editar una consulta (solo admin).
     */
    public function edit($id)
    {
        $consulta = Consulta::with('centro_medico')->findOrFail($id);
        $centrosMedicos = Centro_Medico::all(); // Obtener todos los centros médicos
        return view('consultas.edit', compact('consulta', 'centrosMedicos'));
    }


    /**
     * Actualiza una consulta en la base de datos (solo admin).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'num' => 'required|string|max:255',
            'tipoSala' => 'required|string|max:255',
            'centro_medico_id' => 'required|exists:centro_medico,id'
        ]);

        $consulta = Consulta::findOrFail($id);
        $consulta->update([
            'num' => $request->num,
            'tipoSala' => $request->tipoSala,
            'centro_medico_id' => $request->centro_medico_id
        ]);

        return redirect()->route('consultas.index')->with('success', 'Consulta actualizada correctamente.');
    }


    /**
     * Elimina una consulta de la base de datos (solo admin).
     */
    public function destroy($id)
    {
        $consulta = Consulta::findOrFail($id);
        $consulta->delete();

        return redirect()->route('consultas.index')->with('success', 'Consulta eliminada correctamente.');
    }
}
