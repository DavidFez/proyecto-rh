<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\AusenciaInjustificada;
use App\Models\AusenciaJustificada;
use App\Models\BoletaPago;
use App\Models\Bonificacion;
use Illuminate\Http\Request;

use App\Models\Cargo;
use App\Models\Empleado;
use App\Models\Incapacidad;
use App\Models\Nomina;
use App\Models\Prestacion;
use App\Models\Vacaciones;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        //---- Funciones para los cargos -
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
        // ----------------------------------------------------------------

        // ------- Funciones para empelados --------------------------------
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

        //----------------------------------------------------------------

        // ------- Funciones para las prestaciones ------------------------
            public function gestionPrestaciones(){

                $listaPrestaciones = Prestacion::all();

                return view('Nominas/gestionPrestaciones', [

                    'prestacionesLista' => $listaPrestaciones
                ]);
            }

            public function editarPrestacion(Request $editPrestacion, $id){

                $usuario = Auth::user();
                if (!Hash::check($editPrestacion->passActual, $usuario->password)) {
                    return back()->with('errorEditPrestacion', 'Su contraseña es incorrecta.');
                }

                $prestacion = Prestacion::where('idPrestacion', $id)->first();
                $prestacion->porcentaje = $editPrestacion->nuevoPorcentaje;
                $prestacion->save();

                return back()->with('resEditPrestacion', 'La prestacion se ha editado, tener en cuanta el cambio');
            }
        //----------------------------------------------------------------

        // ------- Funciones para las bonificaciones ------------------------
            public function gestionBonificaciones(){

                $empleadoBonificacion = Empleado::all();
        
                return view('Nominas/gestionBonificaciones', [

                    'bonificacionEmpleado' => $empleadoBonificacion
                ]);
                
            }

            public function guardarBonificacion(Request $datosBonificacion){

                $bonificaion = new Bonificacion();
                $bonificaion->idEmpleado = $datosBonificacion->bonoEmpleado; 
                $bonificaion->bonificacion = $datosBonificacion->bonoConcepto;
                $bonificaion->monto = $datosBonificacion->boonoMnto;

                $bonificaion->save();

                return back()->with('resGuardarBono', 'La bonificacion se ha registrado');

            }

            public function mostrarBinificaciones(Request $fechasBonos){

                // Obtener las fechas del request
                $fechaInicial = $fechasBonos->input('fecha1Bono');
                $fechaFinal = $fechasBonos->input('fecha2Bono');

                // Realizar la consulta para obtener las bonificaciones en el rango de fechas
                $bonificaciones = Bonificacion::whereBetween('fechaBonificacion', [$fechaInicial, $fechaFinal])->with('empleados')->get();

                // Retornar una vista con las bonificaciones obtenidas
                return view('Nominas/bonificacionesOtorgadas', [
                    'listaBonos' => $bonificaciones, 
                    'fechaInicial' => $fechaInicial,
                    'fechaFinal' => $fechaFinal
                ]);

            }

        //----------------------------------------------------------------

        // ------- Funciones para la nomina ------------------------
            public function gestionNomina() {

                $empleadosNomina = Empleado::with('cargo')->get();
                return view('Nominas/nominaEmpleados', [
                    'nominaEmpleados' => $empleadosNomina
                ]);
            }

            public function ingresarEmpleadoNomina(Request $fechasNomina){

                $idDeEmpleado = $fechasNomina->input('idEmpleado');
                $fechaInicial = $fechasNomina->input('nominaFecha1');
                $fechaFinal = $fechasNomina->input('nominaFecha2');

                $registroNomina = new Nomina(); //hacer el registro a la db
                $empleadoNomina = Empleado::with('cargo')->where('idEmpleado', $idDeEmpleado)->first();

                $diasLaborados = Asistencia::where('idEmpleado', $idDeEmpleado)
                ->whereBetween('fecha', [$fechaInicial, $fechaFinal])
                ->where('tipoDia', 'laboral')
                ->count();
                $diasDescanso = Asistencia::where('idEmpleado', $idDeEmpleado)
                ->whereBetween('fecha', [$fechaInicial, $fechaFinal])
                ->where('tipoDia', 'descanso')
                ->count();


                $incapacidad = Incapacidad::where('idEmpleado', $idDeEmpleado)
                ->whereBetween('fechaInicio', [$fechaInicial, $fechaFinal])
                ->first();
                $fechasIncapacidad = optional($incapacidad)->fechaInicio && optional($incapacidad)->fechaFin
                ? optional($incapacidad)->fechaInicio . ' - ' . optional($incapacidad)->fechaFin
                : 'No hubo incapacidad';


                $faltasInjus = AusenciaInjustificada::where('idEmpleado', $idDeEmpleado)
                ->whereBetween('fecha', [$fechaInicial, $fechaFinal])
                ->count();
                $faltasJus = AusenciaJustificada::where('idEmpleado', $idDeEmpleado)
                ->whereBetween('fecha', [$fechaInicial, $fechaFinal])
                ->count();


                $bono = Bonificacion::where('idEmpleado', $idDeEmpleado)
                ->whereBetween('fechaBonificacion', [$fechaInicial, $fechaFinal])
                ->first();
                $montoBono = optional($bono)->monto ?? 0;
                $bonoConcepto = optional($bono)->bonificacion ?? 'No hay registro';

                $vacacion = Vacaciones::where('idEmpleado', $idDeEmpleado)
                ->whereBetween('fechaInicio', [$fechaInicial, $fechaFinal])
                ->first();
                $montoVacaciones = optional($vacacion)->montoVacaciones ?? 0;
                $fechasVacacion = optional($vacacion)->fechaInicio ? optional($vacacion)->fechaInicio . ' - ' . optional($vacacion)->fechaFin : 'No hay registro';

                $prestacionAFP = Prestacion::where('tipoPrestacion', 'patronal')
                ->where('prestacion', 'AFP')
                ->first();
                $prestacionISSS = Prestacion::where('tipoPrestacion', 'patronal')
                ->where('prestacion', 'ISSS')
                ->first();
                $prestacionINSA = Prestacion::where('tipoPrestacion', 'patronal')
                ->where('prestacion', 'INSA')
                ->first();

                $porcentajePatronaAfp = $prestacionAFP->porcentaje / 100;
                $porcentajePatronaIsss = $prestacionISSS->porcentaje / 100;
                $porcentajePatronalInsa = $prestacionINSA->porcentaje / 100;

                $salarioBruto = $empleadoNomina->cargo->salario + $montoVacaciones;
                $isss = round($salarioBruto * $porcentajePatronaIsss, 2);
                $afp = round($salarioBruto * $porcentajePatronaAfp, 2);
                $insa = round($isss * $porcentajePatronalInsa, 2);

                $totalDisponer = $salarioBruto + $isss + $afp + $insa;

                $datosGenerarNomina = [
                    'fecha1' => $fechaInicial,
                    'fecha2' => $fechaFinal,
                    'nombre' => $empleadoNomina->nombres,
                    'apellido' => $empleadoNomina->apellidos,
                    'cargo' => $empleadoNomina->cargo->nombreCargo,
                    'salarioCargo' => $empleadoNomina->cargo->salario,
                    'diasLaborados' => $diasLaborados,
                    'diasDescanso' => $diasDescanso,
                    'periodoVacaciones' => $fechasVacacion,
                    'cargoVacaciones' => $montoVacaciones,
                    'periodoIncapacidad' => $fechasIncapacidad,
                    'asistenciaJus' => $faltasJus,
                    'asistenciaInjus' => $faltasInjus,
                    'salarioBruto' => $salarioBruto,
                    'isss' => $isss,
                    'afp' => $afp,
                    'insa' => $insa,
                    'bonoConcepto' => $bonoConcepto,
                    'bonificacion' => $montoBono,
                    'totalDisponer' => $totalDisponer,
                    'isssPorcentaje' => $prestacionISSS->porcentaje,
                    'afpPocentaje' => $prestacionAFP->porcentaje,
                    'insaPorcentaje' => $prestacionINSA->porcentaje 
                ];

                
                $registroNomina->fechaRegistro = date('Y-m-d');
                $registroNomina->fecha1 = $datosGenerarNomina['fecha1'];
                $registroNomina->fecha2 = $datosGenerarNomina['fecha2'];
                $registroNomina->nombreEmpleado = $datosGenerarNomina['nombre']. ' '. $datosGenerarNomina['apellido'];
                $registroNomina->cargo = $datosGenerarNomina['cargo'];
                $registroNomina->salarioCargo = $datosGenerarNomina['salarioCargo'];
                $registroNomina->diasLaborados = $datosGenerarNomina['diasLaborados'];
                $registroNomina->diasDescanso = $datosGenerarNomina['diasDescanso'];
                $registroNomina->periodoVacaciones = $datosGenerarNomina['periodoVacaciones'];
                $registroNomina->cargoVacaciones = $datosGenerarNomina['cargoVacaciones'];
                $registroNomina->periodoIncapacidad = $datosGenerarNomina['periodoIncapacidad'];
                $registroNomina->asistenciaJus = $datosGenerarNomina['asistenciaJus'];
                $registroNomina->asistenciaInjus = $datosGenerarNomina['asistenciaInjus'];
                $registroNomina->salarioBruto = $datosGenerarNomina['salarioBruto'];
                $registroNomina->isss = $datosGenerarNomina['isss'];
                $registroNomina->afp = $datosGenerarNomina['afp'];
                $registroNomina->insa = $datosGenerarNomina['insa'];
                $registroNomina->bonoConcepto = $datosGenerarNomina['bonoConcepto'];
                $registroNomina->bonificacion = $datosGenerarNomina['bonificacion'];
                $registroNomina->totalDisponer = $datosGenerarNomina['totalDisponer'];
                $registroNomina->id_empleado = $idDeEmpleado;

                $registroNomina->save();
                $idNomina = $registroNomina->idNomina;
                

                return view('Nominas/tablaNomina', [
                    'generarNomina' => $datosGenerarNomina,
                    'nominaId' => $idNomina
                ]);
            }


            public function generarBoletaPago($id){

                $nomina = Nomina::find($id);
                $empleado = Empleado::where('idEmpleado', $nomina->id_empleado)->first();
                $boletaPago = new BoletaPago();

                $prestacionAFP = Prestacion::where('tipoPrestacion', 'trabajador')
                ->where('prestacion', 'AFP')
                ->first();

                $prestacionISSS = Prestacion::where('tipoPrestacion', 'trabajador')
                ->where('prestacion', 'ISSS')
                ->first();


                $isss =  round($nomina->salarioBruto * ($prestacionISSS->porcentaje / 100), 2);
                $afp = round($nomina->salarioBruto * ($prestacionAFP->porcentaje / 100), 2);

                /*
                    Tramos del 
                    Tramos del Ministerio de Hacienda vigentes
                    Nota. Agregar las tasas de isss y afp a la Base de Datos
                */
                $renta = 0;

                $salarioNominal = $nomina->salarioBruto - $isss - $afp;

                if ($salarioNominal > 0.01 && $salarioNominal <= 472) {
                    
                    $renta = round(0, 2);
                }
                elseif ($salarioNominal >= 472.01 && $salarioNominal <= 895.24) {
                    
                    $renta = round((($salarioNominal - 472) * 0.1) + 17.67, 2);

                }
                elseif ($salarioNominal >= 895.25 && $salarioNominal <= 2038.10) {
                    
                    $renta = round( (($salarioNominal - 895.24) * 0.2) + 60, 2);
                    
                }
                elseif ($salarioNominal >= 2038.11) { 
                    
                    $renta = round((($salarioNominal - 2038.10) * 0.3) + 288.57, 2);
                }

                $salarioNeto = round(($nomina->salarioBruto - $isss - $afp - $renta) + $nomina->bonificacion, 2);
                $totalDescuentos = round($isss + $afp + $renta, 2);

                //Crear el pdf de la boleta de pago
                $data = [
                    'empleador' => 'The Burger Rock',
                    'fechaIncorporacion' => $empleado->fechaIncorporacion,
                    'nombre' => $nomina->nombreEmpleado,
                    'cargo' => $nomina->cargo,
                    'metodoPago' => 'deposito en '.$empleado->banco,
                    'cuenta' => $empleado->cuentaDeposito,
                    'periodoLaborado' => $nomina->fecha1.' - '.$nomina->fecha2,
                    'fechaPago' => $nomina->fecha2,
                    'salarioBruto' => $nomina->salarioBruto,
                    'recargoVacaciones' => $nomina->cargoVacaciones,
                    'bonificaciones' => $nomina->bonificacion,
                    'diasDescanso' => $nomina->diasDescanso,
                    'isss' => $isss,
                    'afp' => $afp,
                    'renta' => $renta,
                    'totalDescuentos' => $totalDescuentos,
                    'salarioNeto' => $salarioNeto,
                    'fechaEmision' => now()->toDateString()
                ];

                $pdf = PDF::loadView('Nominas/formatoBoletaPago', $data);
                $pdfPath = 'boletas_pago/boleta_' . $id . '.pdf';
                Storage::disk('public')->put($pdfPath, $pdf->output());

                $boletaPago->fechaRegistro = date('Y-m-d');

                $generarBoleta = [
                    'nombre' => $nomina->nombreEmpleado,
                    'cargo' => $nomina->cargo,
                    'salarioCargo' => $nomina->salario,
                    'diasLaborados' => $nomina->diasLaborados,
                    'vacaciones' => $nomina->cargoVacaciones,
                    'bonos' => $nomina->bonificacion,
                    'salario' => $nomina->salarioBruto,
                    'isss' => $isss,
                    'afp' => $afp,
                    'renta' => $renta,
                    'salarioNeto' => $salarioNeto,
                    'fecha1' => $nomina->fecha1,
                    'fecha2' => $nomina->fecha2,
                    'diasDescanso' => $nomina->diasDescanso,
                    'totalDescuentos' => $totalDescuentos

                ];

                return view('Nominas/verBoletaPago', [
                    'boletaDatos' => $generarBoleta
                ]);
                
            }

        //----------------------------------------------------------------
        
    //-------------------------------------------------------------------------------------------------------------------
    

    //--------------- FUNCIONES PARA LA PARTE DE TIEMPOS Y HORARISO ----------------------------------------------------
        
        // ------- Funciones para las asistencias ------------------------
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
                $asistencia->tipoDia = 'laboral';
                $asistencia->horaEntrada = '11:00:00'; // 11 de la mañana
                $asistencia->horaSalida = '20:00:00'; // 8 de la noche

                $asistencia->save();

                return redirect()->route('nominaGestionAsistencia')->with('resGuardarAsistencia', 'Asistencia guardada con éxito');
            }

            public function gestionDescanso(){

                $asistenciaEmpleados = Empleado::with('cargo')->get();

                return view('GestionHorariosTiempo/diaDescanso', [
                    'empleadosDescanso' => $asistenciaEmpleados
                ]);
            }

            public function marcarDescanso($id)
            {
                $asistencia = new Asistencia();
                $fechaActual = date('Y-m-d');

                // Verificar si ya existe una asistencia para el empleado en la fecha actual
                $existeAsistencia = Asistencia::where('idEmpleado', $id)->where('fecha', $fechaActual)->exists();

                if ($existeAsistencia) {

                    return back()->with('resErrorDescanso', 'Ya se marcó el descanso.');
                }


                $asistencia->idEmpleado = $id;
                $asistencia->fecha = $fechaActual;
                $asistencia->tipoDia = 'descanso';

                $asistencia->save();

                return back()->with('resGuardarDescanso', 'Descanso guradado con éxito');
            }

            public function toalDiasLaborados(Request $fechaDiasLaborados){

                
                $fechaInicio = $fechaDiasLaborados->input('fechaLabor1');
                $fechaFin = $fechaDiasLaborados->input('fechaLabor2');

                // Contar los días laborados por cada empleado en el rango de fechas
                $diasLaborados = Asistencia::select('idEmpleado')
                    ->selectRaw('COUNT(*) as totalDias')
                    ->whereBetween('fecha', [$fechaInicio, $fechaFin])
                    ->groupBy('idEmpleado')
                    ->with(['empleado' => function($query) {
                        $query->select('idEmpleado', 'nombres', 'apellidos');
                    }])
                    ->get();

                // Pasar el resultado a la vista o devolver como JSON
                return view('GestionHorariosTiempo/diasLaborados', [

                    'diasLaborados' => $diasLaborados,
                    'fechaInicio' => $fechaInicio,
                    'fechaFin' => $fechaFin
                ]);

            }

        //----------------------------------------------------------------

        // ------- Funciones para las incapacidades ------------------------
            public function gestionIncacapacidades(){

                $empleados = Empleado::all();

                return view('GestionHorariosTiempo/gestionIncapacidades', [

                    'seleccionarEmpleado' => $empleados
                ]);
            }

            public function resgitrarIncapacidad(Request $datosIncapacidad)
            {
                // Crear una nueva instancia de Incapacidad
                $incapacidad = new Incapacidad();

                // Asignar los valores recibidos a las propiedades del objeto Incapacidad
                $incapacidad->idEmpleado = $datosIncapacidad->incapacidadEmpleado;
                $incapacidad->fechaRegistro = date('Y-m-d');
                $incapacidad->fechaInicio = $datosIncapacidad->fechaInicioIcapaciadad;
                $incapacidad->fechaFin = $datosIncapacidad->fechaFinIncapacidad;
                $incapacidad->motivo = $datosIncapacidad->motivoIncapacidad;

                
                if ($datosIncapacidad->hasFile('archivoIncapacidad')) {
                    $archivo = $datosIncapacidad->archivoIncapacidad;
                    $ruta = Storage::disk('public')->put('Incapacidades', $archivo);
            
                    // Guardar la ruta del archivo en la base de datos
                    $incapacidad->constancia = $ruta;
                }

                $incapacidad->save();

                return redirect()->route('nominaGestionIncapacidades')->with('resGuardarIncapacidad', 'Incapacidad guardada con éxito');
            }

        //----------------------------------------------------------------

        // ------- Funciones para las ausencias Jus e Injus ------------------------
            public function gestionAsenciasInjus(){

                $empleadoAusencia = Empleado::all();

                return view('GestionHorariosTiempo/ausenciaInjs', [

                    'ausenciaEmpleado' => $empleadoAusencia
                ]);
            }

            public function resgitrarAsenciasInjus(Request $datosAusencia){
            
                $ausencia = new AusenciaInjustificada();

                $ausencia->idEmpleado = $datosAusencia->ausenciaInjEmpleado;
                $ausencia->fecha = $datosAusencia->fechaAunsenciaInj;
                $ausencia->comentario = $datosAusencia->comentarioAusenciaInj;

                $ausencia->save();

                return back()->with('resGuardarAusenciaInjus', 'Se ha registraro la ausencia al trabajador');
            }

            public function gestionAsenciasJus(){

                $empleadoAuJus = Empleado::all();

                return view('GestionHorariosTiempo/ausenciaJus', [

                    'auseniaJus' => $empleadoAuJus
                ]);
            }

            public function resgitrarAsenciasJus(Request $datosAusenciaJus){
            
                $ausencia = new AusenciaJustificada();

                $ausencia->idEmpleado = $datosAusenciaJus->ausenciaJusEmpleado;
                $ausencia->fecha = $datosAusenciaJus->fechaAusenciaJus;
                $ausencia->motivoJustificado = $datosAusenciaJus->motivoAusenciaJus;

                $ausencia->save();

                return back()->with('resGuardarAusenciaJus', 'Se ha registrado la justificacion de ausencia');
            }

        //----------------------------------------------------------------

        // ------- Funciones para las vacaciones ------------------------
            public function gestionVaciones(){

                $mesInicio = Carbon::now()->startOfMonth()->toDateString();
                $mesFin = Carbon::now()->endOfMonth()->toDateString();

                $listaVaciones = Vacaciones::whereBetween('fechaInicio', [$mesInicio, $mesFin])
                ->with(['datoEmpleado' => function($query) {
                    $query->select('idEmpleado', 'nombres', 'apellidos');
                }])->get();

                return view('GestionHorariosTiempo/gestionVacaciones', [
                    'vacacionesLista' => $listaVaciones,
                    'fechaInicio' => $mesInicio,
                    'fechaFin' => $mesFin
                ]);
            }

            public function vistaRegistrarVacaciones(){
                
                $vacacionEmpleado = Empleado::all();
                return view('GestionHorariosTiempo/asignarVacacion', [
                    'empleadoVacacion' => $vacacionEmpleado
                ]);
            }

            public function registrarVacaciones(Request $datosVacacion){

                $vacacion = new Vacaciones();
                $empleado = Empleado::with('cargo')->where('idEmpleado', $datosVacacion->vacacionEmpleado)->first();
                $salario = $empleado->cargo->salario;
                $cargoVacaciones = ($salario/2) * 0.30;

                $vacacion->idEmpleado = $datosVacacion->vacacionEmpleado;
                $vacacion->fechaInicio = $datosVacacion->vacacionInicio;
                $vacacion->fechaFin = $datosVacacion->vacacionFin;
                $vacacion->totalDias = $datosVacacion->diasDeVacion;
                $vacacion->montoVacaciones = $cargoVacaciones;
                $vacacion->comentario = $datosVacacion->comentarioVacacion;

                $vacacion->save();

                return redirect()->route('gestionVacaciones')->with('resGuardarVacacion', 'Las Vacaciones se han registrado con exito');
            }

            public function verDetalleVacacion($idVacacion){

                $detalleVacacion = Vacaciones::with([
                    'datoEmpleado' => function($query) {
                        $query->select('idEmpleado', 'nombres', 'apellidos', 'idCargo');
                    },
                    'datoEmpleado.datosCargo' => function($query) {
                        $query->select('idCargo', 'nombreCargo', 'salario');
                    }
                ])->where('idVacacion', $idVacacion)->first();

                return view('GestionHorariosTiempo/detallesVacacion', [

                    'vacacionDetalle' => $detalleVacacion
                ]);
            }
        //----------------------------------------------------------------

    //-------------------------------------------------------------------------------------------------------------------
}
