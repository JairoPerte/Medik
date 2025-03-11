<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    protected $table = 'receta';

    protected $fillable = [
        'fechaini',
        'fechacad'
    ];

    public function medicamentos()
    {
        return $this->belongsToMany(Medicamento::class, 'medicamento_receta')
            ->withPivot('cantidad', 'horario');
    }
}
