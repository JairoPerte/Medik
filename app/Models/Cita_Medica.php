<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita_Medica extends Model
{
    use HasFactory;

    protected $table = 'citas_medicas';

    protected $fillable = [
        'dia',
        'orden',
        'hora',
        'hora_ini',
        'hora_fin',
        'Doctor_id',
        'Consulta_id',
        'Usuario_id',
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

}
