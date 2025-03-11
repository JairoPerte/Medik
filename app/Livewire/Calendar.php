<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cita_Medica;

use Illuminate\Support\Facades\Auth;

class Calendar extends Component
{
    public $citas = [];


    public function fetchCitas()
    {
        $this->citas = Cita_Medica::where('user_id', Auth::guard("web")->id())->with('doctor')->get()->map(function ($cita) {
            return [
                'id' => $cita->id,
                'title' => 'Cita con Dr.' . ($cita->doctor ? $cita->doctor->nombre : 'Desconocido'),
                'start' => date('Y-m-d\TH:i:s', strtotime(date('Y-m-d', strtotime($cita->fecha_hora)) . ' ' . $cita->hora_ini)),
                'end' => date('Y-m-d\TH:i:s', strtotime(date('Y-m-d', strtotime($cita->fecha_hora)) . ' ' . $cita->hora_fin)),
                'descripcion' => 'Cita con el/la Doctor@' . ($cita->doctor ? $cita->doctor->nombre : 'Desconocido') . ' empieza a ' . date('Y-m-d\TH:i:s', strtotime(date('Y-m-d', strtotime($cita->fecha_hora)) . ' ' . $cita->hora_ini)) . ' termina a las ' . date('Y-m-d\TH:i:s', strtotime(date('Y-m-d', strtotime($cita->fecha_hora)) . ' ' . $cita->hora_fin))
            ];
        });
    }




    public function render()
    {
        $this->fetchCitas();
        return view('livewire.calendar');
    }
}
