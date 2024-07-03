<?php
namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Expediente;
use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpedienteController extends Controller
{
    public function index()
    {
        $expedientes = Expediente::with('empleado.cargo')->get();
        return view('GestionReclutamiento.expedientes.index', compact('expedientes'));
    }

    public function create()
    {
        $cargos = Cargo::all();
        return view('GestionReclutamiento.expedientes.create', compact('cargos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:150',
            'apellidos' => 'required|string|max:150',
            'direccion' => 'required|string',
            'fechaNacimiento' => 'required|date',
            'telefono' => 'required|string|max:15',
            'correo' => 'nullable|string|max:100',
            'dui' => 'required|string|max:12',
            'fechaIncorporacion' => 'required|date',
            'cv' => 'nullable|file|mimes:pdf|max:2048',
            'cuentaDeposito' => 'nullable|string',
            'banco' => 'nullable|string',
            'nombreCargo' => 'required|string|max:150',
            'descripcionCargo' => 'nullable|string',
            'salario' => 'required|numeric|min:0',
            'constancia_policia' => 'nullable|file|mimes:pdf|max:2048',
            'titulos_cursos' => 'nullable|file|mimes:pdf|max:2048',
            'puesto_trabajo' => 'nullable|string|max:255',
            'departamento' => 'nullable|string|max:255',
            'estado_empleado' => 'nullable|string|max:255',
        ]);

        $cvPath = $request->hasFile('cv') ? $request->file('cv')->store('cvs', 'public') : null;
        $constanciaPath = $request->hasFile('constancia_policia') ? $request->file('constancia_policia')->store('constancias-policia', 'public') : null;
        $titulosPath = $request->hasFile('titulos_cursos') ? $request->file('titulos_cursos')->store('titulos-cursos', 'public') : null;

        $cargo = Cargo::create([
            'nombreCargo' => $request->nombreCargo,
            'descripcionCargo' => $request->descripcionCargo,
            'salario' => $request->salario,
        ]);

        $empleado = Empleado::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'direccion' => $request->direccion,
            'fechaNacimiento' => $request->fechaNacimiento,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'dui' => $request->dui,
            'fechaIncorporacion' => $request->fechaIncorporacion,
            'cv' => $cvPath,
            'cuentaDeposito' => $request->cuentaDeposito,
            'banco' => $request->banco,
            'idCargo' => $cargo->idCargo,
        ]);

        Expediente::create([
            'idEmpleado' => $empleado->idEmpleado,
            'constancia_policia' => $constanciaPath,
            'titulos_cursos' => $titulosPath,
            'puesto_trabajo' => $request->puesto_trabajo,
            'departamento' => $request->departamento,
            'estado_empleado' => $request->estado_empleado,
        ]);

        return redirect()->route('expedientes.index')->with('success', 'Expediente creado exitosamente.');
    }

    public function show(Expediente $expediente)
    {
        return view('GestionReclutamiento.expedientes.show', compact('expediente'));
    }

    public function edit(Expediente $expediente)
    {
        $cargos = Cargo::all();
        return view('GestionReclutamiento.expedientes.edit', compact('expediente', 'cargos'));
    }

    public function update(Request $request, Expediente $expediente)
    {
        $request->validate([
            'nombres' => 'required|string|max:150',
            'apellidos' => 'required|string|max:150',
            'direccion' => 'required|string',
            'fechaNacimiento' => 'required|date',
            'telefono' => 'required|string|max:15',
            'correo' => 'nullable|string|max:100',
            'dui' => 'required|string|max:12',
            'fechaIncorporacion' => 'required|date',
            'cv' => 'nullable|file|mimes:pdf|max:2048',
            'cuentaDeposito' => 'nullable|string',
            'banco' => 'nullable|string',
            'nombreCargo' => 'required|string|max:150',
            'descripcionCargo' => 'nullable|string',
            'salario' => 'required|numeric|min:0',
            'constancia_policia' => 'nullable|file|mimes:pdf|max:2048',
            'titulos_cursos' => 'nullable|file|mimes:pdf|max:2048',
            'puesto_trabajo' => 'nullable|string|max:255',
            'departamento' => 'nullable|string|max:255',
            'estado_empleado' => 'nullable|string|max:255',
        ]);

        $empleado = $expediente->empleado;
        $cargo = $empleado->cargo;

        if ($request->hasFile('cv')) {
            Storage::disk('public')->delete($empleado->cv);
            $cvPath = $request->file('cv')->store('cvs', 'public');
            $empleado->cv = $cvPath;
        }

        $cargo->update([
            'nombreCargo' => $request->nombreCargo,
            'descripcionCargo' => $request->descripcionCargo,
            'salario' => $request->salario,
        ]);

        $empleado->update([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'direccion' => $request->direccion,
            'fechaNacimiento' => $request->fechaNacimiento,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'dui' => $request->dui,
            'fechaIncorporacion' => $request->fechaIncorporacion,
            'cuentaDeposito' => $request->cuentaDeposito,
            'banco' => $request->banco,
        ]);

        if ($request->hasFile('constancia_policia')) {
            Storage::disk('public')->delete($expediente->constancia_policia);
            $constanciaPath = $request->file('constancia_policia')->store('constancias-policia', 'public');
            $expediente->constancia_policia = $constanciaPath;
        }

        if ($request->hasFile('titulos_cursos')) {
            Storage::disk('public')->delete($expediente->titulos_cursos);
            $titulosPath = $request->file('titulos_cursos')->store('titulos-cursos', 'public');
            $expediente->titulos_cursos = $titulosPath;
        }

        $expediente->update([
            'puesto_trabajo' => $request->puesto_trabajo,
            'departamento' => $request->departamento,
            'estado_empleado' => $request->estado_empleado,
        ]);

        return redirect()->route('expedientes.index')->with('success', 'Expediente actualizado exitosamente.');
    }

    public function destroy(Expediente $expediente)
    {
        Storage::disk('public')->delete($expediente->constancia_policia);
        Storage::disk('public')->delete($expediente->titulos_cursos);
        Storage::disk('public')->delete($expediente->empleado->cv);

        $expediente->empleado->delete();
        $expediente->delete();

        return redirect()->route('expedientes.index')->with('success', 'Expediente eliminado exitosamente.');
    }
}
