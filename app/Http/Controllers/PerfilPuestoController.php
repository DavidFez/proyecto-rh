<?php

namespace App\Http\Controllers;

use App\Models\DescriptorPuesto;
use App\Models\PerfilPuesto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Dompdf;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\View\Factory as ViewFactory;

class PerfilPuestoController extends Controller
{
    public function index()
    {
        $perfiles = PerfilPuesto::all();
        return view('GestionReclutamiento.perfilPuesto.index', compact('perfiles'));
    }

    public function create()
    {
        $puestos = DescriptorPuesto::all();
        return view('GestionReclutamiento.perfilPuesto.create', compact('puestos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idDescpPuesto' => 'required|exists:tbl_descriptorpuestos,idDescpPuesto',
            'edad' => 'required|string',
            'sexo' => 'required|string',
            'estadoCivil' => 'required|string',
            'escolaridad' => 'required|string',
            'residenciaPreferente' => 'required|string',
            'nacionalidad' => 'required|string',
            'idiomas' => 'required|string',
            'disponibilidad' => 'required|string',
            'conocimientosEspecificos' => 'required|string',
            'experienciasPrevias' => 'required|integer',
            'caracteristicasHabilidades' => 'required|string',
        ]);

        PerfilPuesto::create($request->all());

        return redirect()->route('perfiles.index')->with('success', 'Perfil de puesto creado exitosamente.');
    }

    public function show(PerfilPuesto $perfil)
    {
        $descripcion = DescriptorPuesto::findOrFail($perfil->idDescpPuesto);
        return view('GestionReclutamiento.perfilPuesto.show', compact('perfil','descripcion'));
    }

    public function edit(PerfilPuesto $perfil)
    {
        $puestos = DescriptorPuesto::all();
        return view('GestionReclutamiento.perfilPuesto.edit', compact('perfil', 'puestos'));
    }

    public function update(Request $request, PerfilPuesto $perfil)
    {
        $request->validate([
            'idDescpPuesto' => 'required|exists:tbl_descriptorPuestos,idDescpPuesto',
            'edad' => 'required|string',
            'sexo' => 'required|string',
            'estadoCivil' => 'required|string',
            'escolaridad' => 'required|string',
            'residenciaPreferente' => 'required|string',
            'nacionalidad' => 'required|string',
            'idiomas' => 'required|string',
            'disponibilidad' => 'required|string',
            'conocimientosEspecificos' => 'required|string',
            'experienciasPrevias' => 'required|integer',
            'caracteristicasHabilidades' => 'required|string',
        ]);

        $perfil->update($request->all());

        return redirect()->route('perfiles.index')->with('success', 'Perfil de puesto actualizado exitosamente.');
    }

    public function destroy(PerfilPuesto $perfil)
    {
        $perfil->delete();
        return redirect()->route('perfiles.index')->with('success', 'Perfil de puesto eliminado exitosamente.');
    }

    public function generarPDF($id)
    {
        $perfil = PerfilPuesto::findOrFail($id);
        $descripcion = DescriptorPuesto::findOrFail($perfil->idDescpPuesto);

        $dompdf = new Dompdf();
        $config = app(Config::class);
        $files = app(Filesystem::class);
        $view = app(ViewFactory::class);

        $pdf = new DomPDFPDF($dompdf, $config, $files, $view);
        $pdf->loadView('GestionReclutamiento.perfilPuesto.perfilPDF', compact('perfil', 'descripcion'));

        $fileName = 'perfil_puesto_' . str_replace(' ', '_', $descripcion->tituloPuesto) . '.pdf';
        return $pdf->download($fileName);
    }
}
