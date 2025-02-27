<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctores';

    protected $fillable = [
        //Datos del doctor
        'nif',
        'nombre',
        'apellido',
        'edad',
        'numtel'
    ];

    //Relaciones Doctor 
    function CitaMedica(){
        return $this->hasMany(CitaMedica::class);
    }

    function Usuario(){
        return $this->hasOne(User::class);
    }

    function Consustas(){
        return $this->belongsToMany(Consulta::class, 'Consultas_has_Doctor', 'Doctor_idDoctor', 'Consultas_idConsultas')
        ->withPivot('pago', 'horario', 'trabaja', 'especialidad');
    }

}
