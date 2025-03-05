<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita_Medica extends Model
{
    use HasFactory;

    protected $table = 'cita_medica';

    protected $fillable = [
        'dia',
        'orden',
        'hora',
        'hora_ini',
        'hora_fin',
        'doctor_id',
        'consulta_id',
        'usuario_id',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function receta()
    {
        return $this->hasOne(Receta::class);
    }
}
