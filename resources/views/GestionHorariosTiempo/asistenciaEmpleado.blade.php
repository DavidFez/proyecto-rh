@extends('dashboard')
@section('titulo', '- Asistencia')

@section('contenido')

    <div class="container">
        <br>
        <h2>Guardar Asistencia de los empleados</h2>
        <hr>
        <br>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Empleado</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                @php
                    $numero = 1 
                @endphp

                @foreach ($empleadosAsistencias as $empleado)

                    <tr>
                        <th scope="row">{{$numero}}</th>
                        <td>{{$empleado->nombres}} {{$empleado->apellidos}}</td>
                        <td>{{$empleado->cargo->nombreCargo}}</td>
                        <td>$ {{$empleado->telefono}}</td>
                        <td>
                            <a href="{{route('nominaMarcarAsistencia', $empleado->idEmpleado)}}" class="btn btn-primary">Marcar Asistencia</a>
                        </td>
                    </tr>

                    @php
                        $numero++
                    @endphp
                @endforeach

                
            </tbody>

        </table>

        <br><br>
        <h2>Ver dias laborales de los empleados por rango de fechas</h2>

        <div class="col-12">
            <div class="p-3 m-1"> <!--Padding y margin del texto-->           
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">Fecha Inicial</th>
                        <th scope="col">Fecha Final</th>
                        <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <form method="POST" action="{{ route('nominaTotalDiasLaborados') }}">
                        @csrf
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <input name="fechaLabor1" type="date" class="form-control" placeholder="Fecha Inicial" style="width: 200px;">
                                </th>
                                <td>
                                    <input name="fechaLabor2" type="date" class="form-control" placeholder="Fecha Final" style="width: 200px;">
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-secondary" id="btnGenerarInforme">Ver dias laborales</button>
                                </td>
                            </tr>
                        </tbody>
                    </form>
                </table>
            </div>
        </div>

    </div>


    @if (Session::has('resGuardarAsistencia'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resGuardarAsistencia') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resErrorAsistencia'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resErrorAsistencia') }}",
                icon: "error"
            });
        </script>  
    @endif

@endsection