<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\DescriptorPuesto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Dompdf;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\View\Factory as ViewFactory;

class DescripcionPuestoController extends Controller
{
    public function index()
    {
        $descripciones = DescriptorPuesto::all();
        return view('GestionReclutamiento.descriptorPuesto.index', compact('descripciones'));
    }

    public function create()
    {
        $departamentos = Departamento::all();
        return view('GestionReclutamiento.descriptorPuesto.create', compact('departamentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fechaElaboracion' => 'required|date',
            'fechaRevision' => 'required|date',
            'tituloPuesto' => 'required|string',
            'operacionArea' => 'required|string',
            'puestoAlQueReporta' => 'required|string',
            'directosCantidad' => 'required|integer',
            'indirectosCantidad' => 'required|integer',
            'propositoPuesto' => 'required|string',
            'funcionesPrincipales' => 'required|string',
            'impactoDecisiones' => 'required|string',
            'idDepartamento' => 'required|exists:tbl_departamentos,idDepartamento',
        ]);

        DescriptorPuesto::create($request->all());

        return redirect()->route('descripciones.index')->with('success', 'Descripción del puesto creada exitosamente.');
    }

    public function show(DescriptorPuesto $descripcion)
    {
        return view('GestionReclutamiento.descriptorPuesto.show', compact('descripcion'));
    }

    public function edit(DescriptorPuesto $descripcion)
    {
        $departamentos = Departamento::all();
        return view('GestionReclutamiento.descriptorPuesto.edit', compact('descripcion', 'departamentos'));
    }

    public function update(Request $request, DescriptorPuesto $descripcion)
    {
        $request->validate([
            'fechaElaboracion' => 'required|date',
            'fechaRevision' => 'required|date',
            'tituloPuesto' => 'required|string',
            'operacionArea' => 'required|string',
            'puestoAlQueReporta' => 'required|string',
            'directosCantidad' => 'required|integer',
            'indirectosCantidad' => 'required|integer',
            'propositoPuesto' => 'required|string',
            'funcionesPrincipales' => 'required|string',
            'impactoDecisiones' => 'required|string',
            'idDepartamento' => 'required|exists:tbl_departamentos,idDepartamento',
        ]);

        $descripcion->update($request->all());

        return redirect()->route('descripciones.index')->with('success', 'Descripción del puesto actualizada exitosamente.');
    }

    public function destroy(DescriptorPuesto $descripcion)
    {
        $descripcion->delete();
        return redirect()->route('descripciones.index')->with('success', 'Descripción del puesto eliminada exitosamente.');
    }

    public function generarPDF($id)
    {
        $descripcion = DescriptorPuesto::findOrFail($id);

        $dompdf = new Dompdf();
        $config = app(Config::class);
        $files = app(Filesystem::class);
        $view = app(ViewFactory::class);

        $pdf = new DomPDFPDF($dompdf, $config, $files, $view);
        $pdf->loadView('GestionReclutamiento.descriptorPuesto.puestoPDF', compact('descripcion'));
        
        $nombrePuesto = str_replace(' ', '_', $descripcion->tituloPuesto);
        $fileName = 'descripcion_puesto_' . $nombrePuesto . '.pdf';
    
        return $pdf->download($fileName);
    }
}
