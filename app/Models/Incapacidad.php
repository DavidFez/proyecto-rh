<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incapacidad extends Model
{
    use HasFactory;

    protected $table = 'tbl_incapacidades';

    protected $fillable = [
        'idEmpleado',
        'fechaRegistro',
        'fechaInicio',
        'fechaFin',
        'motivo',
        'constancia',
    ];

    public function empleados()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado', 'idEmpleado');
    }
}

