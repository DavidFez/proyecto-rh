<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AusenciaInjustificada extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_ausencias_injustificadas';

    protected $fillable = [
        'idEmpleado',
        'fecha',
        'comentario',
    ];

    // Relación con el modelo Empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado', 'idEmpleado');
    }
}
