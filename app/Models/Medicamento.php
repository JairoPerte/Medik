<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $table = 'medicamento';

    protected $fillable = [
        'nombre',
        'marca',
        'precio',
        'cantidad',
        'peso',
        'aplicacion',
    ];

    public function recetas()
    {
        return $this->belongsToMany(Receta::class, 'medicamento_receta')
            ->withPivot('cantidad', 'horario')
            ->withTimestamps();
    }
}
