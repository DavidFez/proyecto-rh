<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PruebaSeleccion extends Model
{
    use HasFactory;

    protected $table = 'tbl_pruebasSeleccion';
    protected $primaryKey = 'idPruebaSeleccion';
    protected $fillable = [
        'idCandidato', 'idDescpPuesto', 'nombreEvaluador', 'Observacion', 'pruebaTecnica', 'pruebaEntrevista',
    ];

    public function candidato()
    {
        return $this->belongsTo(Candidato::class, 'idCandidato', 'idCandidato');
    }

    public function puesto()
    {
        return $this->belongsTo(DescriptorPuesto::class, 'idDescpPuesto', 'idDescpPuesto');
    }
}
