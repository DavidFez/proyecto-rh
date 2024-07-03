<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use Illuminate\Http\Request;

class SeguimientoCandidatoController extends Controller
{
    public function index()
    {
        // Obtener todos los candidatos con la relación 'puesto'
        $candidatos = Candidato::with('puesto')->get();
    
        // Actualizar el estado y el resultado de la evaluación dinámicamente
        foreach ($candidatos as $candidato) {
            $candidato->update([
                'estado' => $candidato->estado,
                'resultadoEvaluacion' => $candidato->resultadoEvaluacion,
            ]);
        }
    
        return view('GestionReclutamiento.seguimiento.index', compact('candidatos'));
    }

    public function create()
    {
        $candidatos = Candidato::all();
        return view('GestionReclutamiento.seguimiento.create', compact('candidatos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idCandidato' => 'required|exists:tbl_candidatos,idCandidato',
            'estado' => 'required|string|max:255',
            'fechaEstado' => 'required|date',
            'comentarios' => 'nullable|string',
            'nombreEvaluador' => 'nullable|string|max:255',
            'fechaEntrevista' => 'nullable|date_format:Y-m-d\TH:i',
            'resultadoEvaluacion' => 'nullable|string|max:255',
        ]);

        $candidato = Candidato::find($request->idCandidato);
        $candidato->update([
            'estado' => $request->estado,
            'fechaEstado' => $request->fechaEstado,
            'comentarios' => $request->comentarios,
            'nombreEvaluador' => $request->nombreEvaluador,
            'fechaEntrevista' => $request->fechaEntrevista,
        ]);

        $this->updateCandidatoEstado($candidato);

        return redirect()->route('seguimiento_candidatos.index')->with('success', 'Seguimiento creado exitosamente.');
    }

    public function show(Candidato $candidato)
    {
        return view('GestionReclutamiento.seguimiento.show', compact('candidato'));
    }

    public function edit(Candidato $candidato)
    {
        return view('GestionReclutamiento.seguimiento.edit', compact('candidato'));
    }

    public function update(Request $request, Candidato $candidato)
    {
        $request->validate([
            'estado' => 'required|string|max:255',
            'fechaEstado' => 'required|date',
            'comentarios' => 'nullable|string',
            'nombreEvaluador' => 'nullable|string|max:255',
            'fechaEntrevista' => 'nullable|date_format:Y-m-d\TH:i',
            'resultadoEvaluacion' => 'nullable|string|max:255',
        ]);

        $candidato->update($request->only([
            'estado', 'fechaEstado', 'comentarios', 'nombreEvaluador', 'fechaEntrevista', 'resultadoEvaluacion'
        ]));

        // Actualizar dinámicamente el estado y resultado de la evaluación
        $this->updateCandidatoEstado($candidato);

        return redirect()->route('seguimiento_candidatos.index')->with('success', 'Seguimiento actualizado exitosamente.');
    }

    private function updateCandidatoEstado(Candidato $candidato)
    {
        if ($candidato->estadoEvaluacionCV !=0  && $candidato->estadoPruebaTecnica !=0 && $candidato->estadoPruebaEntrevista !=0) {
            $candidato->estado = 'Finalizado';
        } else {
            $candidato->estado = 'En Proceso';
        }

        $promedio = ($candidato->puntajeCV + $candidato->puntajePruebaTecnica + $candidato->puntajePruebaEntrevista) / 3;

        if ($promedio > 80) {
            $candidato->resultadoEvaluacion = 'Aprobado';
        } else {
            $candidato->resultadoEvaluacion = 'Rechazado';
        }

        $candidato->save();
    }

    public function destroy(Candidato $candidato)
    {
        $candidato->delete();
        return redirect()->route('seguimiento_candidatos.index')->with('success', 'Seguimiento eliminado exitosamente.');
    }
}