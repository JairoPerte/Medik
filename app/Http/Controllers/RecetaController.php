<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;
use App\Models\Receta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

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
    public function create(Request $request)
    {
        $citaid = $request->cita;
        $medicamentos = Medicamento::all();
        return view('recetas.create', compact('citaid', 'medicamentos'));
    }

    /**
     * Guarda una nueva receta en la base de datos (solo admin).
     */
    public function store(Request $request)
    {
        // Validar datos
        $request->validate([
            'fechaIni' => 'required|date',
            'fechaCad' => 'required|date',
            'cita_id' => 'required|exists:cita_medica,id',
            'medicamentos' => 'nullable|array',
            'medicamentos.*.medicamento_id' => 'exists:medicamento,id',
            'medicamentos.*.cantidad' => 'required|integer|min:1',
            'medicamentos.*.horario' => 'required|string|max:100',
        ]);

        // dd($request);

        // Crear nueva receta
        $receta = Receta::create([
            'fechaIni' => $request->fechaIni,
            'fechaCad' => $request->fechaCad,
            'cita_id' => (int) $request->cita_id,
        ]);

        // Guardar medicamentos en la tabla intermedia
        if ($request->has('medicamentos')) {
            foreach ($request->medicamentos as $medicamento) {
                DB::table('medicamento_receta')->insert([
                    'receta_id' => $receta->id,
                    'medicamento_id' => $medicamento['medicamento_id'],
                    'cantidad' => $medicamento['cantidad'],
                    'horario' => $medicamento['horario'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Redireccionar
        return redirect()->route('dashboard')->with('success', 'Receta creada correctamente.');
    }

    public function recetasUser()
    {
        $usuario = User::with([
            'citas.receta' => function ($query) {
                $query->where('fechaCad', '>=', Carbon::today());
            },
            'citas.receta.medicamentos' => function ($query) {
                $query->select(
                    'medicamento.id',
                    'medicamento.nombre',
                    'medicamento.precio',
                    'medicamento.aplicacion',
                    'medicamento.cantidad'
                )->withPivot('cantidad', 'horario');
            }
        ])->findOrFail(Auth::guard('web')->user()->id);

        return view('recetas.user', compact('usuario'));
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
