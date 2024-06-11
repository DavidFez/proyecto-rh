<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;

use App\Models\Cargo;
use App\Models\Empleado;
use App\Models\Prestacion;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

class VistasAdminController extends Controller
{
    public function mostrarIndex()
    {
        return view('VistasAdministrador.inicioAdmin');
    }

    public function mostrarVistaDescriptor()
    {
        return view('descriptorPuestoTrabajo.descriptorPuesto');
    }

    //----------------------- FUNCIONES PARA EL MODULO DE NOMINAS Y PRESTACIONES DE LEY ---------------------------------

        public function gestionsDeCargos(){

            $listaCargos = Cargo::all();
            return view('Nominas/gestionCargos', [
                
                'cargosDeLaEmpresa' => $listaCargos
            ]);
        }

        public function crearCargo(Request $datosCargo){

            $cargo = new Cargo();

            $cargo->nombreCargo = $datosCargo->nombreCargo;
            $cargo->descripcionCargo = $datosCargo->descripcionCargo;
            $cargo->salario = $datosCargo->salarioCargo;

            $cargo->save();

            return redirect()->route('verGestionCargos')->with('resGuardarCargo', 'El cargo se ha guardado correctamente');

        }

        public function gestionDeEmpleados()
        {
            $listaEmpleados = Empleado::with('cargo')->get();

            return view('Nominas/gestionEmpleados', [
                'empleados' => $listaEmpleados
            ]);
        }

        public function vistaAgregarEmpleado(){

            $cargosDisponibles = Cargo::all();

            return view('Nominas/agregarEmpleado', [

                'cargoTrabajador' => $cargosDisponibles
            ]);
        }
        
        public function guardarEmpleado(Request $request){

            $empleado = new Empleado();

            // Asignar valores a los atributos del modelo Empleado
            $empleado->idCargo = $request->input('cargoEmpleado');
            $empleado->nombres = $request->input('nombreEmpleado');
            $empleado->apellidos = $request->input('apellidoEmpleado');
            $empleado->direccion = $request->input('direccionEmpleado');
            $empleado->fechaNacimiento = $request->input('fechaNacimientoEmpleado');
            $empleado->telefono = $request->input('telefonoEmpleado');
            $empleado->correo = $request->input('correoEmpleado');
            $empleado->dui = $request->input('duiEmpleado');
            $empleado->fechaIncorporacion = $request->input('fechaIngresoEmpelado');
            
            // Guardar el archivo del CV si existe
            if ($request->hasFile('cvEmpleado')) {
                $archivo = $request->cvEmpleado;
                $ruta = Storage::disk('public')->put('Curriculos', $archivo);
        
                // Guardar la ruta del archivo en la base de datos
                $empleado->cv = $ruta;
            }

            $empleado->cuentaDeposito = $request->input('cuentaEmpleado');
            $empleado->banco = $request->input('bancoEmpleado');
            
            // Guardar el empleado en la base de datos
            $empleado->save();

            // Redirigir a una ruta con un mensaje de éxito
            return redirect()->route('nominaGestionEmpleados')->with('resGuardarEmpleado', 'Empleado guardado con éxito');
        }

        public function verDatosDelEmpleado($id)
        {
            $datosEmpleado = Empleado::with('cargo')->where('idEmpleado', $id)->get();

            return view('Nominas/verEmpleado', [
                'datosVerEmpleado' => $datosEmpleado
            ]);
        }

        public function gestionPrestaciones(){

            $listaPrestaciones = Prestacion::all();

            return view('Nominas/gestionPrestaciones', [

                'prestacionesLista' => $listaPrestaciones
            ]);
        }

        public function gestionBonificaciones(){

            $empleadoBonificacion = Empleado::all();
    
            return view('Nominas/gestionBonificaciones', [

                'bonificacionEmpleado' => $empleadoBonificacion
            ]);
            
        }

    //-------------------------------------------------------------------------------------------------------------------
    
    //--------------- FUNCIONES PARA LA PARTE DE TIEMPOS Y HORARISO ----------------------------------------------------
        
        public function gestionAsistencias(){

            $asistenciaEmpleados = Empleado::with('cargo')->get();

            return view('GestionHorariosTiempo/asistenciaEmpleado', [
                'empleadosAsistencias' => $asistenciaEmpleados
            ]);
        }

        public function guardarAsistencia($id){


            $asistencia = new Asistencia();
            $fechaActual = date('Y-m-d');

            // Verificar si ya existe una asistencia para el empleado en la fecha actual
            $existeAsistencia = Asistencia::where('idEmpleado', $id)->where('fecha', $fechaActual)->exists();

            if ($existeAsistencia) {

                return redirect()->route('nominaGestionAsistencia')->with('resErrorAsistencia', 'Ya se marcó asistencia.');
            }

            

            $asistencia->idEmpleado = $id;
            $asistencia->fecha = $fechaActual;
            $asistencia->horaEntrada = '11:00:00'; // 11 de la mañana
            $asistencia->horaSalida = '20:00:00'; // 8 de la noche

            $asistencia->save();

            return redirect()->route('nominaGestionAsistencia')->with('resGuardarAsistencia', 'Asistencia guardada con éxito');
        }

    //-------------------------------------------------------------------------------------------------------------------
}
