<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Empleado extends Model
{
    use HasFactory;

    protected $table = "tbl_empleado";
    protected $primaryKey = 'idEmpleado';

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

    public function datosCargo(){
        return $this->belongsTo(Cargo::class, 'idCargo', 'idCargo')->select('idCargo', 'nombreCargo', 'salario');
    }

    public function asistencia(){
        return $this->hasMany(Asistencia::class, 'idEmpleado', 'idEmpleado');
    }

    public function bonoficaciones(){
        return $this->hasMany(Bonificacion::class, 'idEmpleado', 'idEmpleado');
    }

    public function incapacidades(){
        return $this->hasMany(Incapacidad::class, 'idEmpleado', 'idEmpleado');
    }

    public function ausenciasInjs(){
        return $this->hasMany(AusenciaInjustificada::class, 'idEmpleado', 'idEmpleado');
    }

    public function ausenciasJus(){
        return $this->hasMany(AusenciaJustificada::class, 'idEmpleado', 'idEmpleado');
    }

    public function vacaciones(){
        return $this->hasMany(Vacaciones::class, 'idEmpleado', 'idEmpleado');
    }
}
