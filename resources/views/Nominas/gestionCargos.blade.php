@extends('dashboard')
@section('titulo', '- Cargos')

@section('contenido')

    <div class="container">

        <h2>Gestión de cargos</h2>
        <hr>
        <a href="{{ route('nominaCrearCargo') }}" class="btn btn-success">+ Agregar Cargo</a>
        <br>
        <br>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Salario</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                @php
                    $numero = 1 
                @endphp

                @foreach ($cargosDeLaEmpresa as $cargo)
                    <tr>
                        <th scope="row">{{$numero}}</th>
                        <td>{{$cargo->nombreCargo}}</td>
                        <td>$ {{$cargo->salario}}</td>
                        <td>
                            <a href="#" class="btn btn-primary">Ver</a>
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
    

    @if (Session::has('resGuardarCargo'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resGuardarCargo') }}",
                icon: "success"
            });
        </script>  
    @endif

@endsection