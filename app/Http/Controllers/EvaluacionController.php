<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\CriterioEvaluacion;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    public function create()
    {
        $empleados = Empleado::all();
        return view('EvaluacionPersonal.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $evaluacion = Evaluacion::create($request->only([
            'idEmpleado', 'rol', 'departamento', 'fecha_evaluacion', 'evaluador', 'nota', 'observaciones'
        ]));

        if ($request->has('criterios')) {
            foreach ($request->criterios as $criterio) {
                $evaluacion->criterios()->create($criterio);
            }
        }

        return redirect()->route('evaluaciones.index')->with('success', 'Evaluación creada exitosamente.');
    }

    public function index()
    {
        $evaluaciones = Evaluacion::with('empleado', 'criterios')->get();
        return view('EvaluacionPersonal.index', compact('evaluaciones'));
    }
}

