<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorasExtra extends Model
{
    use HasFactory;

    protected $table = "tbl_horas_extra";
    protected $primaryKey = 'idHoraExtra';

    protected $fillable = [
        'idEmpleado',
        'fecha',
        'horaInicio',
        'horaFin',
        'totalHorasExtra',
        'montoHorasExtra'
    ];

    public function empleados() {

        return $this->belongsTo(Empleado::class, 'idEmpleado', 'idEmpleado');
    }

}

