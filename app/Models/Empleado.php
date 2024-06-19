<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'tbl_empleado';
    protected $primaryKey = 'idEmpleado';
    protected $fillable = [
        'idCargo', 'nombres', 'apellidos', 'direccion', 'fechaNacimiento',
        'telefono', 'correo', 'dui', 'fechaIncorporacion', 'cv', 'cuentaDeposito', 'banco'
    ];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'idCargo');
    }

    public function expediente()
    {
        return $this->hasOne(Expediente::class, 'idEmpleado');
    }
}