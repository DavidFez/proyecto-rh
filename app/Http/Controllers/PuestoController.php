<?php

namespace App\Http\Controllers;

use App\Models\tbl_departamento;
use App\Models\tbl_puesto;
use Illuminate\Http\Request;

class PuestoController extends Controller
{
    public function index()
    {
        $puestos = tbl_puesto::all();
        return view('descriptorPuestoTrabajo.descriptorPuesto', compact('puestos'));
    }

    public function create()
    {
        $departamentos = tbl_departamento::all();
        return view('descriptorPuestoTrabajo.DescriptorCreate', compact('departamentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombrePuesto' => 'required',
            'descripPuesto' => 'nullable',
            'competencias' => 'nullable',
            'responsabilidades' => 'nullable',
            'requisitos' => 'nullable',
            'idDepartamento' => 'required|exists:tbl_departamentos,idDepartamento'
        ]);

        tbl_puesto::create($request->all());

        return redirect()->route('descriptorPuesto')->with('success', 'Puesto creado exitosamente.');
    }

    public function show(tbl_puesto $puesto)
    {
        return view('descriptorPuestoTrabajo.descriptorShow', compact('puesto'));
    }

    public function edit(tbl_puesto $puesto)
    {
        $departamentos = tbl_departamento::all();
        return view('descriptorPuestoTrabajo.descriptorEdit', compact('puesto', 'departamentos'));
    }

    public function update(Request $request, tbl_puesto $puesto)
    {
        $request->validate([
            'nombrePuesto' => 'required',
            'descripPuesto' => 'nullable',
            'competencias' => 'nullable',
            'responsabilidades' => 'nullable',
            'requisitos' => 'nullable',
            'idDepartamento' => 'required|exists:departamentos,idDepartamento'
        ]);

        $puesto->update($request->all());

        return redirect()->route('descriptorPuesto')->with('success', 'Puesto actualizado exitosamente.');
    }

    public function destroy(tbl_puesto $puesto)
    {
        $puesto->delete();
        return redirect()->route('descriptorPuesto')->with('success', 'Puesto eliminado exitosamente.');
    }
}
