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

    public function centroMedico()
    {
        return $this->belongsTo(Centro_Medico::class);
    }

}
