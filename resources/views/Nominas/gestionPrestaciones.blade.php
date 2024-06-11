@extends('dashboard')
@section('titulo', '- Prestaciones')

@section('contenido')

    <div class="container">
        <br>
        <h2>Gestión de prestaciones de ley</h2>
        <hr>
        <br>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Prestacion</th>
                    <th scope="col">Tipo Prestacion</th>
                    <th scope="col">Procentaje</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                @php
                    $numero = 1 
                @endphp

                @foreach ($prestacionesLista as $prestacion)

                    <tr>
                        <th scope="row">{{$numero}}</th>
                        <td>{{$prestacion->prestacion}}</td>
                        <td>{{$prestacion->tipoPrestacion}}</td>
                        <td>% {{$prestacion->porcentaje}}</td>
                        <td>
                            <a href="#" class="btn btn-primary">Editar</a>
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




