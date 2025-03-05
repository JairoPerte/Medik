<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Administrador extends Authenticatable
{
    protected $table = 'Administrador';

    protected $fillable = [
        'nif',
        'nombre',
        'apellido',
        'edad'
    ];

    //Funciones de relaciones
    function Centro_Medico()
    {
        return $this->belongsToMany(Centro_Medico::class, 'admin_centro', 'administrador_id', 'centro_medico_id')
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

    public function getAuthIdentifierName()
    {
        return 'id';
    }
}
