<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    use HasFactory;

    protected $table = 'tbl_nomina';
    protected $primaryKey = 'idNomina';

    //Para esta tabla se necesitan horas extras del empleado, horario diurno o noctiurno
    
    protected $fillable = [
        'fechaRegistro',
        'fecha1',
        'fecha2',
        'nombreEmpleado',
        'cargo',
        'salarioCargo',
        'diasLaborados',
        'diasDescanso',
        'periodoVacaciones',
        'cargoVacaciones',
        'periodoIncapacidad',
        'asistenciaJus',
        'asistenciaInjus',
        'salarioBruto',
        'isss',
        'afp',
        'insa',
        'bonoConcepto',
        'bonificacion',
        'totalDisponer',
        'id_empleado',
    ];
}
