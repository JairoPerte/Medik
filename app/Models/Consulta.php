<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $table = 'consulta';

    protected $fillable = [
        'num',
        'tipoSala',
        'centro_medico_id'
    ];

    public function centro_medico()
    {
        return $this->belongsTo(Centro_Medico::class, 'centro_medico_id');
    }

    public function doctores()
    {
        return $this->belongsToMany(Doctor::class, 'consulta_doctor')
            ->withPivot('horario', 'pago', 'trabaja', 'especialidad');
    }
}
