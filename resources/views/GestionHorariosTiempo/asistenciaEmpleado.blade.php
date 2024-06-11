@extends('dashboard')
@section('titulo', '- Empleados')

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