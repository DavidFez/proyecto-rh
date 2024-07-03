<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;

    protected $table = 'tbl_expedientes';
    protected $primaryKey = 'idExpediente';
    protected $fillable = [
        'idEmpleado', 'constancia_policia', 'titulos_cursos', 'puesto_trabajo',
        'departamento', 'estado_empleado'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado');
    }
}
