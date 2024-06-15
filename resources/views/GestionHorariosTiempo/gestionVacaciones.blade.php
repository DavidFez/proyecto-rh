@extends('dashboard')
@section('titulo', '- Vacaciones')

@section('contenido')

    <div class="container">

        @php
        $meses = [
            "01" => "Enero",
            "02" => "Febrero",
            "03" => "Marzo",
            "04" => "Abril",
            "05" => "Mayo",
            "06" => "Junio",
            "07" => "Julio",
            "08" => "Agosto",
            "09" => "Septiembre",
            "10" => "Octubre",
            "11" => "Noviembre",
            "12" => "Diciembre"
        ];

        $mesEvaluar = date('m');

        $mes = $meses[$mesEvaluar] ?? "No encontrado";
        @endphp

        <h2>Vacaciones de empleados</h2>
        <hr>
        <a href="{{route('vistaRegistrarVacaciones')}}" class="btn btn-success">+ Asignar Vacaciones</a>
        
        <br><br><br>

        <h2>Vacaciones asignadas en: {{$mes}} de {{date('Y')}}</h2>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Empleado</th>
                    <th scope="col">Inicio Vacaciones</th>
                    <th scope="col">Fin Vacaciones</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @php
                    $numero = 1 
                @endphp

                @foreach ($vacacionesLista as $vacaciones)
                    <tr>
                        <td>{{$numero}}</td>
                        <td>{{ $vacaciones->datoEmpleado->nombres}} {{$vacaciones->datoEmpleado->apellidos}}</td>
                        <td>{{ $vacaciones->fechaInicio }}</td>
                        <td>{{ $vacaciones->fechaFin}}</td>
                        <td> 
                            <a href="{{route('verDetalleDeVacacion', $vacaciones->idVacacion)}}" class="btn btn-primary">Ver</a>
                        </td>
                    </tr>

                    @php
                        $numero++;
                    @endphp
                @endforeach
            </tbody>
    
        </table>

    </div>
    

    @if (Session::has('resGuardarVacacion'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resGuardarVacacion') }}",
                icon: "success"
            });
        </script>  
    @endif

@endsection