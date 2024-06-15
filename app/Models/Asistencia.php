<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = "tbl_dias_laborales";

    protected $fillable = [
        'idEmpleado',
        'fecha',
        'tipoDia',
        'horaEntrada', 
        'horaSalida'
    ];

    public function empleado(){

        return $this->belongsTo(Empleado::class, 'idEmpleado', 'idEmpleado')->select(['idEmpleado', 'nombres', 'apellidos']);

    }


}
