<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = "tbl_empleado";

    protected $fillable = [
        'idCargo',
        'nombres',
        'apellidos',
        'direccion',
        'fechaNacimiento',
        'telefono',
        'correo',
        'dui',
        'fechaIncorporacion',
        'cv',
        'cuentaDeposito',
        'banco'
    ];

    public function cargo(){

        return $this->belongsTo(Cargo::class, 'idCargo', 'idCargo');
    }

    public function asistencia(){
        return $this->hasMany(Asistencia::class, 'idEmpleado', 'idEmpleado');
    }
}
