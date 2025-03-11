<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\Centro_Medico;

class ConsultaController extends Controller
{
    public function index()
    {
        $consultas = Consulta::with('centroMedico')->get();
        return view('consultas.index', compact('consultas'));
    }

    public function create()
    {
        $centrosMedicos = Centro_Medico::all(); 
        return view('consultas.create', compact('centrosMedicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'num' => 'required|string|max:45',
            'tipoSala' => 'required|string|max:45',
            'CentroMedico_id' => 'required|exists:centro_medicos,id',
        ]);

        Consulta::create($request->only(['num', 'tipoSala', 'CentroMedico_id']));

        return redirect()->route('consultas.index')->with('success', 'Consulta creada correctamente.');
    }

    public function show(Consulta $consulta)
    {
        return view('consultas.show', compact('consulta'));
    }

    public function edit(Consulta $consulta)
    {
        $centrosMedicos = Centro_Medico::all(); 
        return view('consultas.edit', compact('consulta', 'centrosMedicos'));
    }

    public function update(Request $request, Consulta $consulta)
    {
        $request->validate([
            'num' => 'required|string|max:45',
            'tipoSala' => 'required|string|max:45',
            'CentroMedico_idCentroMedico' => 'required|exists:centro_medicos,id',
        ]);

        $consulta->update($request->only(['num', 'tipoSala', 'CentroMedico_idCentroMedico']));

        return redirect()->route('consultas.index')->with('success', 'Consulta actualizada correctamente.');
    }

    public function destroy(Consulta $consulta)
    {
        $consulta->delete();
        return redirect()->route('consultas.index')->with('success', 'Consulta eliminada correctamente.');
    }
}
