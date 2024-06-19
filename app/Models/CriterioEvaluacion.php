<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriterioEvaluacion extends Model
{
    use HasFactory;

    protected $table = 'tbl_criterios_evaluacion';
    protected $primaryKey = 'id_criterio';

    protected $fillable = [
        'id_evaluacion', 'criterio', 'descripcion', 'escala'
    ];

    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class, 'id_evaluacion');
    }
}

