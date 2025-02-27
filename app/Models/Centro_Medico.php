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
        return $this->belongsToMany(Administrador::class, 'CentroMedico_has_Administrador', 'CentroMedico_idCentroMedico', 'Administrador_idAdministrador')
            ->withPivot('horario', 'sueldo', 'trabaja');
    }
}
