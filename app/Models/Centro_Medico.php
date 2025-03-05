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
    function administrador()
    {
        return $this->belongsToMany(Administrador::class, 'admin_centro', 'centro_medico_id', 'administrador_id')
            ->withPivot('horario', 'sueldo', 'trabaja');
    }
}
