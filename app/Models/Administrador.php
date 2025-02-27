<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = 'Administrador';

    protected $fillable = [
        'nif',
        'nombre',
        'apellido',
        'edad'
    ];

    //Funciones de relaciones 
    function Centro_Medico(){
        return $this->belongsToMany(Centro_Medico::class, 'CentroMedico_has_Administrador', 'Administrador_idAdministrador', 'CentroMedico_idCentroMedico')
        ->withPivot('horario', 'sueldo', 'trabaja');
    }

    protected $hidden = [
        'password',
        'remember_token'
    ];

        /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


}
