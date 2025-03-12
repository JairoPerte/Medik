<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    protected $table = 'receta';

    protected $fillable = [
        'fechaIni',
        'fechaCad',
        'cita_id'
    ];

    public function medicamentos()
    {
        return $this->belongsToMany(Medicamento::class, 'medicamento_receta')
            ->withPivot('cantidad', 'horario');
    }

    public function cita()
    {
        return $this->belongsTo(Cita_Medica::class, 'cita_id');
    }
}
