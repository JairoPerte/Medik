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
        return $this->hasMany(Cita_Medica::class);
    }

    function Usuario(){
        return $this->hasOne(User::class);
    }

    function Consustas(){
        return $this->belongsToMany(Consulta::class, 'consulta_doctor', 'Doctor_id', 'Consulta_id')
        ->withPivot('pago', 'horario', 'trabaja', 'especialidad');
    }

}
