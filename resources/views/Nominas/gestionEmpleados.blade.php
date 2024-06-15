@extends('dashboard')
@section('titulo', '- Empleados')

@section('contenido')

    <div class="container">
        <br>
        <h2>Gestión de empleados</h2>
        <hr>
        <a href="{{route('nominaAgregarEmpleado')}}" class="btn btn-success">+ Agregar Empleado</a>
        <br>
        <br>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Empleado</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Salario</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                @php
                    $numero = 1 
                @endphp

                @foreach ($empleados as $empleado)

                    <tr>
                        <th scope="row">{{$numero}}</th>
                        <td>{{$empleado->nombres}} {{$empleado->apellidos}}</td>
                        <td>{{$empleado->cargo->nombreCargo}}</td>
                        <td>$ {{$empleado->cargo->salario}}</td>
                        <td>
                            <a href="{{route('nominaVerDatosEmpleado', $empleado->idEmpleado)}}" class="btn btn-primary">Ver</a>
                            <a href="#" class="btn btn-secondary">Editar</a>
                        </td>
                    </tr>

                    @php
                        $numero++
                    @endphp
                @endforeach

                
            </tbody>

        </table>

    </div>


    @if (Session::has('resGuardarEmpleado'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resGuardarEmpleado') }}",
                icon: "success"
            });
        </script>  
    @endif

@endsection




