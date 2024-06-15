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
                            <button class="btn btn-primary" data-bs-target="#exampleModalToggle{{$numero}}" data-bs-toggle="modal">Editar</button>
                        </td>
                    </tr>

                    @php
                        $numero++
                    @endphp
                @endforeach

                
            </tbody>

        </table>

        @php
            $contador = 1;
        @endphp
        @foreach ($prestacionesLista as $item)

        <div class="modal fade" id="exampleModalToggle{{$contador}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">AVISO</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            
                            <div>
                                El cambio de esta prestacion puede tener consecuencias legales. El cambio debe estar 
                                sujeto a los porcentajes establecidos por la ley actualmente.
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2-{{$contador}}" data-bs-toggle="modal">Estoy decuerdo, continuar</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="exampleModalToggle2-{{$contador}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Editar Prestacion</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="formEditarPrestacion" action="{{route('editarPrestacionDeLey', $item->idPrestacion)}}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Prestacion: {{$item->prestacion}}</label>
                            </div>

                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Porcentaje:</label>
                                <input type="text" class="form-control" name="nuevoPorcentaje" value="{{$item->porcentaje}}">
                            </div>

                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Ingrese su contraseña:</label>
                                <input type="password" class="form-control" name="passActual">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Cambiar Porcentaja</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    
            @php
                $contador++;
            @endphp
        @endforeach

    </div>

    @if (Session::has('errorEditPrestacion'))
    <script>
        Swal.fire({
            title: "Informacion",
            text: "{{ session('errorEditPrestacion') }}",
            icon: "error"
        });
    </script>  
    @endif

    @if (Session::has('resEditPrestacion'))
    <script>
        Swal.fire({
            title: "Informacion",
            text: "{{ session('resEditPrestacion') }}",
            icon: "success"
        });
    </script>  
    @endif

@endsection

@section('jsVistasAdmin')

    <script>

        $('.formEditarPrestacion').on('submit', function(e){
            
            e.preventDefault();
            Swal.fire({
                title: "¿Está seguro?",
                text: "Se cambiará el porcentaje de la prestacion",
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
