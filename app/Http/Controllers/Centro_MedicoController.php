<?php

namespace App\Http\Controllers;

use App\Models\Centro_Medico;
use Illuminate\Http\Request;

class Centro_MedicoController extends Controller
{
    public function index()
    {
        $centros = Centro_Medico::all();
        return view('centros.index', compact('centros'));
    }

    public function create()
    {
        return view('centros.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'localidad' => 'required',
            'calle' => 'required',
        ]);

        Centro_Medico::create($request->all());

        return redirect()->route('centros.index')->with('success', 'Centro Médico creado correctamente.');
    }

    public function edit(Centro_Medico $centroMedico)
    {
        return view('centros.edit', compact('centroMedico'));
    }

    public function show(Centro_Medico $centroMedico)
    {
        return view('centros.show', compact('centroMedico'));
    }

    public function update(Request $request, Centro_Medico $centroMedico)
    {
        $request->validate([
            'nombre' => 'required',
            'localidad' => 'required',
            'calle' => 'required',
        ]);

        $centroMedico->update($request->all());

        return redirect()->route('centros.index')->with('success', 'Centro Médico actualizado correctamente.');
    }

    public function destroy(Centro_Medico $centroMedico)
    {
        $centroMedico->delete();

        return redirect()->route('centros.index')->with('success', 'Centro Médico eliminado correctamente.');
    }
}
