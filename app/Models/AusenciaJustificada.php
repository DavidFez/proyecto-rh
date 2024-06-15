<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AusenciaJustificada extends Model
{
    use HasFactory;

    // Especificar la tabla asociada al modelo
    protected $table = "tbl_ausencias_justificadas";

    // Definir los campos que pueden ser llenados masivamente
    protected $fillable = [
        'idEmpleado',
        'fecha',
        'motivoJustificado',
    ];

    // Definir la relación con el modelo Empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado', 'idEmpleado');
    }
}
