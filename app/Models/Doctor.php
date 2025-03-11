<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctor';

    protected $fillable = [
        //Datos del doctor
        'nif',
        'nombre',
        'apellido',
        'edad',
        'numtel'
    ];

    //Relaciones Doctor
    function citaMedica()
    {
        return $this->hasMany(Cita_Medica::class);
    }

    function usuario()
    {
        return $this->hasOne(User::class);
    }

    function consultas()
    {
        return $this->belongsToMany(Consulta::class, 'consulta_doctor', 'doctor_id', 'consulta_id')
            ->withPivot('pago', 'horario', 'trabaja', 'especialidad');
    }
}
