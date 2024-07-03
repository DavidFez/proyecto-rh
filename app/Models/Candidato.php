<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;
    protected $table = 'tbl_candidatos';
    protected $primaryKey = 'idCandidato';
    protected $fillable = [
        'nombre', 'correo', 'telefono', 'direccion', 'curriculum', 'dui', 'puesto_aplicado_id', 
        'puntajePruebaTecnica', 'puntajePruebaEntrevista', 'puntajeCV', 'estadoEvaluacionCV', 
        'estadoPruebaTecnica', 'estadoPruebaEntrevista','estado','nombreEvaluador','resultadoEvaluacion',
        'comentarios',
    ];

    public function puesto()
    {
        return $this->belongsTo(DescriptorPuesto::class, 'puesto_aplicado_id', 'idDescpPuesto');
    }


    public function getEstadoAttribute()
    {
        if ($this->estadoEvaluacionCV && $this->estadoPruebaTecnica && $this->estadoPruebaEntrevista) {
            return 'Finalizado';
        }
        return 'En Proceso';
    }
}
