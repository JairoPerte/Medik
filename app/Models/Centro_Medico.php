<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Centro_Medico extends Model
{
    protected $table = 'centro_medico';

    protected $fillable = [
        'nombre',
        'telefono',
        'localidad',
        'calle'
    ];

    //Funciones de relaciones
    function Administrador(){
        return $this->belongsToMany(Administrador::class, 'admin_centro', 'CentroMedico_id', 'Administrador_id')
            ->withPivot('horario', 'sueldo', 'trabaja');
    }
}
