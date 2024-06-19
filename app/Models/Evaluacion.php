<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones';
    protected $primaryKey = 'id_evaluacion';

    protected $fillable = [
        'idEmpleado', 'rol', 'departamento', 'fecha_evaluacion', 'evaluador', 'nota', 'observaciones'
    ];

    public function criterios()
    {
        return $this->hasMany(CriterioEvaluacion::class, 'id_evaluacion');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado');
    }

    public function getEmpleadoNombreAttribute()
    {
        return $this->empleado->nombre;
    }

    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'idCargo');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'idDepartamento');
    }
}

