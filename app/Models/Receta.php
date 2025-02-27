<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    protected $table = 'consultas';

    protected $fillable = [
        'fechaini',
        'fechaCad',
        'Cita_Medica_id',
    ];

    public function cita_medica()
    {
        return $this->belongsTo(Cita_Medica::class);
    }
}
