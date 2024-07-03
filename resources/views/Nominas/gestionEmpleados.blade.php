@extends('dashboard')
@section('titulo', '- Empleados')

@section('contenido')

    <div class="container">
        <br>
        <h2>Gestión de empleados</h2>
        <hr>
        <a href="{{route('nominaAgregarEmpleado')}}" class="btn btn-insertar">+ Agregar Empleado</a>
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
                        <td class="d-flex gap-2">
                            <a href="{{route('nominaVerDatosEmpleado', $empleado->idEmpleado)}}" class="btn btn-ver">Ver</a>
                            <a href="{{route('editarDatosEmpleado', $empleado->idEmpleado)}}" class="btn btn-editar">Editar</a>

                            <form class="formEliminarEmpleado" action="{{route('eliminarEmpleadoOrganizacion', $empleado->idEmpleado)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Eliminar </button>
                            </form>
                            
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

    @if (Session::has('reEditEmpleado'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('reEditEmpleado') }}",
                icon: "success"
            });
        </script>  
    @endif

    @if (Session::has('resDesactivarEmpleado'))
    <script>
        Swal.fire({
            title: "Informacion",
            text: "{{ session('resDesactivarEmpleado') }}",
            icon: "success"
        });
    </script>  
@endif

@endsection

@section('jsVistasAdmin')

    <script>

        $('.formEliminarEmpleado').on('submit', function(e){
            
            e.preventDefault();
            Swal.fire({
                title: "¿Está seguro?",
                text: "El empleado dejará de formar parte de la organización",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, continuar"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit()
                } 
            });
        })

    </script>
@endsection




