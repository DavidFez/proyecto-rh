<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoletaPago extends Model
{
    use HasFactory;

    protected $table = "tbl_boleta_pago";
    protected $primaryKey = 'idBoleta';

    protected $fillable = [
        'fechaRegistro',
        'fechaIncorporacion',
        'nombreEmpleado',
        'cargo',
        'salarioCargo',
        'periodoLaborado',
        'diasLaborados',
        'diasDescanso',
        'metodoPago',
        'cuentaPago',
        'fechaPago',
        'periodoVacaciones',
        'cargoVacaciones',
        'periodoIncapacidad',
        'asistenciaJus',
        'asistenciaInjus',
        'salarioBruto',
        'isss',
        'afp',
        'renta',
        'totalDescuentos',
        'bonoConcepto',
        'bonificacion',
        'salarioNeto',
        'id_empleado',
        'archivoBoleta'
    ];
    
}
