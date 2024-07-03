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
        'empleado',
        'cargo',
        'salarioBruto',
        'afp',
        'isss',
        'renta',
        'otro',
        'aguinaldo',
        'totalDescuento',
        'salarioNeto',
        'boleta', 
    ];
    
}
