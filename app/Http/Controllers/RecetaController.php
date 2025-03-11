<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receta;

class RecetaController extends Controller
{
    public function index()
    {
        $recetas = Receta::all();
        return view('recetas.index', compact('recetas'));
    }

    public function create()
    {
        return view('recetas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'paciente_id' => 'required|exists:users,id',
            'medico_id' => 'required|exists:users,id',
        ]);

        Receta::create($request->all());

        return redirect()->route('recetas.index')->with('success', 'Receta creada correctamente.');
    }

    public function edit(Receta $receta)
    {
        return view('recetas.edit', compact('receta'));
    }

    public function update(Request $request, Receta $receta)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'paciente_id' => 'required|exists:users,id',
            'medico_id' => 'required|exists:users,id',
        ]);

        $receta->update($request->all());

        return redirect()->route('recetas.index')->with('success', 'Receta actualizada correctamente.');
    }

    public function destroy(Receta $receta)
    {
        $receta->delete();
        return redirect()->route('recetas.index')->with('success', 'Receta eliminada correctamente.');
    }
}
