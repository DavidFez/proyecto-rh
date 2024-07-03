<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asuetos extends Model
{
    use HasFactory;

    protected $table = "tbl_asuetos";
    protected $primaryKey = 'idAsueto';
    
    protected $fillable = [
        'idEmpleado',
        'fecha',
        'asueto',
        'horaInicio',
        'horaFin',
        'horasExtra',
        'totalAsueto'
    ];

    public function empleado(){
        return $this->belongsTo(Empleado::class, 'idEmpleado', 'idEmpleado');
    }

}
