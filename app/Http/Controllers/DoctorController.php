<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Muestra una lista de todas las consultas (accesible para todos los usuarios autenticados).
     */
    public function index()
    {
        $doctores = Doctor::all();
        return view('doctores.index', compact('doctores'));
    }

    // Mostrar un solo doctor (Web y Admin)
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctores.show', compact('doctor'));
    }

    // Mostrar el formulario de creación (Solo Admin)
    public function create()
    {
        return view('doctores.create');
    }

    // Guardar un nuevo doctor (Solo Admin)
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'nif' => 'required|unique:doctores,nif|max:20',
            'edad' => 'required|integer|min:25',
            'numtel' => 'required|string|max:20',
        ]);

        Doctor::create($request->all());

        return redirect()->route('doctores.index')->with('success', 'Doctor agregado correctamente.');
    }

    // Editar un doctor (Solo Admin)
    public function edit($id)
    {
        return view('doctores.edit', compact('doctor'));
    }

    // Actualizar datos de un doctor (Solo Admin)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'nif' => 'required|max:20|unique:doctores,nif,' . $id,
            'edad' => 'required|integer|min:25',
            'numtel' => 'required|string|max:20',
        ]);

        $doctor = Doctor::findOrFail($id);
        $doctor->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'nif' => $request->nif,
            'edad' => $request->edad,
            'numtel' => $request->numtel,
        ]);

        return redirect()->route('doctores.index')->with('success', 'Doctor actualizado.');
    }

    // Eliminar un doctor (Solo Admin)
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return redirect()->route('doctores.index')->with('success', 'Doctor eliminado.');
    }
}
