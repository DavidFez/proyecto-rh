<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacaciones extends Model
{
    use HasFactory;

    protected $table = "tbl_vacaciones";

    protected $fillable = [
        'idEmpleado',
        'fechaInicio',
        'fechaFin',
        'totalDias',
        'montoVacaciones',
        'comentario'
    ];

    public function empleado() {

        return $this->belongsTo(Empleado::class, 'idEmpleado', 'idEmpleado');
    }
    public function datoEmpleado() {
        return $this->belongsTo(Empleado::class, 'idEmpleado', 'idEmpleado')->select(['idEmpleado', 'nombres', 'apellidos']);
    }
}
