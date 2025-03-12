<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita_Medica extends Model
{
    use HasFactory;

    protected $table = 'cita_medica';

    protected $fillable = [
        'orden',
        'fecha_hora',
        'hora_ini',
        'hora_fin',
        'doctor_id',
        'consulta_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }

    public function receta()
    {
        return $this->hasOne(Receta::class, 'cita_id');
    }

    public function paciente()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function medico()
    {
        return $this->belongsTo(User::class, 'medico_id');
    }

    public function centroMedico()
    {
        return $this->belongsTo(Centro_Medico::class);
    }
}
