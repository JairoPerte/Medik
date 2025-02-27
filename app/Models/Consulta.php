<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $table = 'consultas';

    protected $fillable = [
        'num',
        'tipo_sala',
        'centro_medico_id'
    ];

    public function centro_medico()
    {
        return $this->belongsTo(Centro_Medico::class);
    }

    public function doctores()
    {
        return $this->belongsToMany(Doctor::class, 'consulta_doctor')
            ->withPivot('horario', 'pago', 'trabaja', 'especialidad')
            ->withTimestamps();
    }

}
