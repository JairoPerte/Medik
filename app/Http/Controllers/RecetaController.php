<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receta;

class RecetaController extends Controller
{
    /**
     * Muestra una lista de todas las recetas (accesible para todos los usuarios autenticados).
     */
    public function index()
    {
        $recetas = Receta::all();
        return view('recetas.index', compact('recetas'));
    }

    /**
     * Muestra el formulario para crear una nueva receta (solo admin).
     */
    public function create()
    {
        return view('recetas.create');
    }

    /**
     * Guarda una nueva receta en la base de datos (solo admin).
     */
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'paciente_id' => 'required|exists:users,id',
            'medico_id' => 'required|exists:users,id',
        ]);

        // Crear nueva receta
        Receta::create([
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'paciente_id' => $request->paciente_id,
            'medico_id' => $request->medico_id,
        ]);

        // Redireccionar a la vista index (lista de recetas)
        return redirect()->route('recetas.index')->with('success', 'Receta creada correctamente.');
    }

    /**
     * Muestra el formulario para editar una receta (solo admin).
     */
    public function edit(Receta $receta)
    {
        return view('recetas.edit', compact('receta'));
    }

    /**
     * Actualiza una receta en la base de datos (solo admin).
     */
    public function update(Request $request, Receta $receta)
    {
        // Validación de datos
        $request->validate([
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'paciente_id' => 'required|exists:users,id',
            'medico_id' => 'required|exists:users,id',
        ]);

        // Actualizar receta
        $receta->update($request->all());

        return redirect()->route('recetas.index')->with('success', 'Receta actualizada correctamente.');
    }

    /**
     * Elimina una receta de la base de datos (solo admin).
     */
    public function destroy(Receta $receta)
    {
        $receta->delete();
        return redirect()->route('recetas.index')->with('success', 'Receta eliminada correctamente.');
    }
}
