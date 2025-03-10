<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Administrador extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'administrador';
    protected $guard = 'admin';
    protected $guarded = [];

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
