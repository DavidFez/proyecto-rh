<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonificacion extends Model
{
    use HasFactory;

    protected $table = "tbl_bonificaciones";

    protected $fillable = [
        'idEmpleado',
        'bonificacion',
        'monto',
        'fechaBonificacion'
    ];

    public function empleados() {

        return $this->belongsTo(Empleado::class, 'idEmpleado', 'idEmpleado');
    }
}
