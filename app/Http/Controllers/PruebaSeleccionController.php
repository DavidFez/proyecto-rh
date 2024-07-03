<?php

namespace App\Http\Controllers;

use App\Models\PruebaSeleccion;
use App\Models\Candidato;
use App\Models\DescriptorPuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PruebaSeleccionController extends Controller
{
    public function index()
    {
        $pruebas = PruebaSeleccion::with(['candidato', 'puesto'])->get();
        return view('GestionReclutamiento.pruebas.index', compact('pruebas'));
    }

    public function create()
    {
        $candidatos = Candidato::all();
        $puestos = DescriptorPuesto::all();
        return view('GestionReclutamiento.pruebas.create', compact('candidatos', 'puestos'));
    }

    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'idCandidato' => 'required|exists:tbl_candidatos,idCandidato',
            'idDescpPuesto' => 'required|exists:tbl_descriptorPuestos,idDescpPuesto',
            'nombreEvaluador' => 'required|string|max:255',
            'Observacion' => 'nullable|string',
            'pruebaTecnica' => 'required|string',
            'pruebaEntrevista' => 'required|string',
            'puntajePruebaTecnica' => 'required|integer|min:0|max:100',
            'puntajePruebaEntrevista' => 'required|integer|min:0|max:100',
        ]);

        // Crear la entrada en la tabla PruebaSeleccion
        $pruebaSeleccion = PruebaSeleccion::create($request->only([
            'idCandidato', 
            'idDescpPuesto', 
            'nombreEvaluador', 
            'Observacion', 
            'pruebaTecnica', 
            'pruebaEntrevista'
        ]));

        $candidato = Candidato::find($request->idCandidato);
        // Calcular el puntaje total
        $puntajeCV = $candidato->puntajeCV * 0.3;
        $puntajePruebaTecnica = $request->puntajePruebaTecnica * 0.4;
        $puntajePruebaEntrevista = $request->puntajePruebaEntrevista * 0.3;
        $puntajeTotal = $puntajeCV + $puntajePruebaTecnica + $puntajePruebaEntrevista;

        // Actualizar los puntajes en la tabla Candidato
       
        $candidato->puntajeCV = $candidato->puntajeCV;
        $candidato->puntajePruebaTecnica = $request->puntajePruebaTecnica;
        $candidato->puntajePruebaEntrevista = $request->puntajePruebaEntrevista;
        $candidato->estadoEvaluacionCV = 1;
        $candidato->estadoPruebaTecnica = 1;
        $candidato->estadoPruebaEntrevista = 1;
        $candidato->resultadoEvaluacion = $puntajeTotal;
        if($puntajeTotal>=70){
            $candidato->estado = 'Aprobado';
        }
        else{
            $candidato->estado = 'Rechazado';
        }
        $candidato->save();

        // Enviar correo al candidato
        $this->enviarCorreo($candidato, $puntajeTotal);

        return redirect()->route('pruebas.index')->with('success', 'Prueba de selección creada exitosamente.');
    }

    private function enviarCorreo($candidato, $puntajeTotal)
    {
        $nombre = $candidato->nombre;
        $correo = $candidato->correo;
        $mensaje = '';

        if ($puntajeTotal >= 70) {
            $mensaje = "Estimado(a) $nombre,\n\nNos complace informarle que ha sido aceptado(a) en nuestra empresa. Su evaluación ha sido exitosa y ha obtenido un puntaje total de $puntajeTotal.\n\n¡Felicidades! Puede comenzar con su proceso de incorporación.\n\nAtentamente,\nEl equipo de Recursos Humanos";
        } else {
            $mensaje = "Estimado(a) $nombre,\n\nGracias por participar en nuestro proceso de selección. Aunque su puntaje total de $puntajeTotal no ha alcanzado el mínimo requerido, le agradecemos su interés y guardaremos su currículum para futuras oportunidades.\n\nAtentamente,\nEl equipo de Recursos Humanos";
        }

        Mail::raw($mensaje, function ($message) use ($correo, $nombre) {
            $message->to($correo)
                    ->subject('Resultado de Evaluación - Empresa de Hamburguesas');
        });
    }

    public function show(PruebaSeleccion $prueba)
    {
        return view('GestionReclutamiento.pruebas.show', compact('prueba'));
    }

    public function edit(PruebaSeleccion $prueba)
    {
        $candidatos = Candidato::all();
        $puestos = DescriptorPuesto::all();
        return view('GestionReclutamiento.pruebas.edit', compact('prueba', 'candidatos', 'puestos'));
    }

    public function update(Request $request, PruebaSeleccion $prueba)
    {
        $request->validate([
            'idCandidato' => 'required|exists:tbl_candidatos,idCandidato',
            'idDescpPuesto' => 'required|exists:tbl_descriptorPuestos,idDescpPuesto',
            'nombreEvaluador' => 'required|string|max:255',
            'Observacion' => 'nullable|string',
            'pruebaTecnica' => 'required|string',
            'pruebaEntrevista' => 'required|string',
            'puntajePruebaTecnica' => 'required|integer|min:0|max:100',
            'puntajePruebaEntrevista' => 'required|integer|min:0|max:100',
        ]);

        $prueba->update($request->all());

        return redirect()->route('pruebas.index')->with('success', 'Prueba de selección actualizada exitosamente.');
    }

    public function destroy(PruebaSeleccion $prueba)
    {
        $prueba->delete();
        return redirect()->route('pruebas.index')->with('success', 'Prueba de selección eliminada exitosamente.');
    }
}
