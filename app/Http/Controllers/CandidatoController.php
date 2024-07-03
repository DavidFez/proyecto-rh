<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\DescriptorPuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidatoController extends Controller
{
    public function index()
    {
        $candidatos = Candidato::with('puesto')->get();
        return view('GestionReclutamiento.candidatos.index', compact('candidatos'));
    }

    public function create()
    {
        $puestos = DescriptorPuesto::all();
        return view('GestionReclutamiento.candidatos.create', compact('puestos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:tbl_candidatos,correo',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'curriculum' => 'required|file|mimes:pdf|max:2048',
            'dui' => 'required|file|mimes:pdf|max:2048',
            'puesto_aplicado_id' => 'required|exists:tbl_descriptorPuestos,idDescpPuesto',
        ]);

        $curriculumPath = $request->file('curriculum')->store('curriculums-candidatos', 'public');
        $duiPath = $request->file('dui')->store('duis-candidatos', 'public');

        Candidato::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'curriculum' => $curriculumPath,
            'dui' => $duiPath,
            'puesto_aplicado_id' => $request->puesto_aplicado_id,
        ]);

        return redirect()->route('candidatos.index')->with('success', 'Candidato creado exitosamente.');
    }

    public function show(Candidato $candidato)
    {
        return view('GestionReclutamiento.candidatos.show', compact('candidato'));
    }

    public function evaluarCV(Request $request, $candidato)
    {
        $candidato = Candidato::find($candidato);
        $id_puesto_aplicado = $candidato->puesto_aplicado_id;
        $puesto = DescriptorPuesto::find($id_puesto_aplicado);
        if (!$candidato) {
            return redirect()->back()->with('error', 'Candidato no encontrado.');
        }

        return view('GestionReclutamiento.evaluaciones.allevaluacion', compact('candidato', 'puesto'));
    }

    public function storeEvaluation(Request $request)
    {
        $request->validate([
            'candidato_id' => 'required|exists:tbl_candidatos,idCandidato',
            'cargo' => 'required|string',
            'nombreEvaluador' => 'required|string|max:255',
            'comentarios' => 'nullable|string',
            'puntaje_total' => 'required|integer|min:0|max:100',
        ]);

        // Validate fields specific to each position
        switch ($request->cargo) {
            case 'Mesero':
                $request->validate([
                    'educacion_secundaria_completa' => 'required|integer|min:0|max:10',
                    'cursos_atencion_cliente' => 'required|integer|min:0|max:10',
                    'experiencia_mesero' => 'required|integer|min:0|max:40',
                    'manejo_pos' => 'required|integer|min:0|max:5',
                    'higiene_seguridad' => 'required|integer|min:0|max:5',
                    'comunicacion' => 'required|integer|min:0|max:5',
                    'resolucion_problemas' => 'required|integer|min:0|max:5',
                    'ingles_basico' => 'required|integer|min:0|max:10',
                    'otros_idiomas' => 'required|integer|min:0|max:10',
                ]);
                break;
            case 'Contador':
                $request->validate([
                    'grado_universitario' => 'required|integer|min:0|max:20',
                    'cursos_contabilidad' => 'required|integer|min:0|max:10',
                    'experiencia_contador' => 'required|integer|min:0|max:30',
                    'software_contable' => 'required|integer|min:0|max:10',
                    'legislacion_fiscal' => 'required|integer|min:0|max:10',
                    'certificacion_cpa' => 'required|integer|min:0|max:5',
                    'actualizacion_fiscal' => 'required|integer|min:0|max:5',
                    'ingles_tecnico' => 'required|integer|min:0|max:5',
                    'otros_idiomas' => 'required|integer|min:0|max:5',
                ]);
                break;
            case 'Chef':
                $request->validate([
                    'grado_universitario_gastronomia' => 'required|integer|min:0|max:20',
                    'cursos_especializacion_cocina' => 'required|integer|min:0|max:10',
                    'experiencia_chef' => 'required|integer|min:0|max:30',
                    'cocina_internacional' => 'required|integer|min:0|max:10',
                    'higiene_seguridad' => 'required|integer|min:0|max:10',
                    'certificaciones_culinarias' => 'required|integer|min:0|max:5',
                    'actualizacion_culinaria' => 'required|integer|min:0|max:5',
                    'ingles_tecnico' => 'required|integer|min:0|max:5',
                    'otros_idiomas' => 'required|integer|min:0|max:5',
                ]);
                break;
            case 'Auxiliar de cocina':
                $request->validate([
                    'educacion_secundaria_completa' => 'required|integer|min:0|max:10',
                    'cursos_basicos_cocina' => 'required|integer|min:0|max:10',
                    'experiencia_auxiliar' => 'required|integer|min:0|max:40',
                    'preparacion_alimentos' => 'required|integer|min:0|max:10',
                    'higiene_seguridad' => 'required|integer|min:0|max:10',
                    'ingles_basico' => 'required|integer|min:0|max:10',
                    'otros_idiomas' => 'required|integer|min:0|max:10',
                ]);
                break;
            case 'Cajero':
                $request->validate([
                    'educacion_secundaria_completa' => 'required|integer|min:0|max:10',
                    'cursos_atencion_cliente' => 'required|integer|min:0|max:10',
                    'experiencia_cajero' => 'required|integer|min:0|max:40',
                    'manejo_pos' => 'required|integer|min:0|max:10',
                    'habilidades_numericas' => 'required|integer|min:0|max:10',
                    'ingles_basico' => 'required|integer|min:0|max:10',
                    'otros_idiomas' => 'required|integer|min:0|max:10',
                ]);
                break;
            case 'Repartidor':
                $request->validate([
                    'educacion_secundaria_completa' => 'required|integer|min:0|max:10',
                    'cursos_conduccion_segura' => 'required|integer|min:0|max:10',
                    'experiencia_repartidor' => 'required|integer|min:0|max:40',
                    'conocimiento_rutas' => 'required|integer|min:0|max:10',
                    'habilidades_conduccion' => 'required|integer|min:0|max:10',
                    'ingles_basico' => 'required|integer|min:0|max:10',
                    'otros_idiomas' => 'required|integer|min:0|max:10',
                ]);
                break;
            case 'Sub-gerencia':
                $request->validate([
                    'grado_universitario' => 'required|integer|min:0|max:20',
                    'cursos_gestion_restaurantes' => 'required|integer|min:0|max:10',
                    'experiencia_sub_gerente' => 'required|integer|min:0|max:40',
                    'gestion_restaurantes' => 'required|integer|min:0|max:10',
                    'liderazgo' => 'required|integer|min:0|max:10',
                    'ingles_tecnico' => 'required|integer|min:0|max:5',
                    'otros_idiomas' => 'required|integer|min:0|max:5',
                ]);
                break;
            default:
                return redirect()->back()->with('error', 'Puesto no válido.');
        }

        $candidato = Candidato::find($request->candidato_id);
        if (!$candidato) {
            return redirect()->back()->with('error', 'Candidato no encontrado.');
        }

        $candidato->update([
            'puntajeCV' => $request->puntaje_total,
            'nombreEvaluador' => $request->nombreEvaluador,
            'comentarios' => $request->comentarios,
            'estadoEvaluacionCV' => 1,
        ]);

        return redirect()->route('candidatos.index')->with('success', 'Evaluación de CV guardada exitosamente.');
    }

    public function edit(Candidato $candidato)
    {
        $puestos = DescriptorPuesto::all();
        return view('GestionReclutamiento.candidatos.edit', compact('candidato', 'puestos'));
    }

    public function update(Request $request, Candidato $candidato)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:tbl_candidatos,correo,' . $candidato->idCandidato. ',idCandidato',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'curriculum' => 'nullable|file|mimes:pdf|max:2048',
            'dui' => 'nullable|file|mimes:pdf|max:2048',
            'puesto_aplicado_id' => 'required|exists:tbl_descriptorPuestos,idDescpPuesto',
        ]);

        if ($request->hasFile('curriculum')) {
            Storage::disk('public')->delete($candidato->curriculum);
            $curriculumPath = $request->file('curriculum')->store('curriculums-candidatos', 'public');
            $candidato->curriculum = $curriculumPath;
        }

        if ($request->hasFile('dui')) {
            Storage::disk('public')->delete($candidato->dui);
            $duiPath = $request->file('dui')->store('duis-candidatos', 'public');
            $candidato->dui = $duiPath;
        }

        $candidato->update([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'curriculum' => $candidato->curriculum,
            'dui' => $candidato->dui,
            'puesto_aplicado_id' => $request->puesto_aplicado_id,
        ]);

        return redirect()->route('candidatos.index')->with('success', 'Candidato actualizado exitosamente.');
    }

    public function destroy(Candidato $candidato)
    {
        Storage::disk('public')->delete($candidato->curriculum);
        Storage::disk('public')->delete($candidato->dui);
        $candidato->delete();
        return redirect()->route('candidatos.index')->with('success', 'Candidato eliminado exitosamente.');
    }
}
