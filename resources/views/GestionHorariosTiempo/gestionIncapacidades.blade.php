@extends('dashboard')
@section('titulo', '- Gestion Incapacidades')

@section('contenido')

    <div class="container">
        <br>
        <h2>Gestion de incapaciodades de empleados</h2>
        <hr>
        <br>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">+ Registrar Incapacidad para un empleado</button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Incapacidad</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="{{route('registrarIncacapacidades')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Empleado:</label>
                                <select name="incapacidadEmpleado" class="form-select" aria-label="Default select example">
                                    <option selected>Seleccione un empleado</option>
                                    @foreach ($seleccionarEmpleado as $empleado)
                                        <option value="{{$empleado->idEmpleado}}">{{$empleado->nombres}} {{$empleado->apellidos}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Fecha de inicio de incapacidad:</label>
                                <input type="date" class="form-control" name="fechaInicioIcapaciadad">
                            </div>
                            
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Fecha fin de incapacidad:</label>
                                <input type="date" class="form-control" name="fechaFinIncapacidad">
                            </div>

                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Motivo de incapaciidad:</label>
                                <textarea name="motivoIncapacidad" class="form-control" id="message-text"></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Subir constancia</label>
                                <input class="form-control" type="file" name="archivoIncapacidad">
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Registrar incapacidad</button>
                            </div>

                        </form>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>

    @if (Session::has('resGuardarIncapacidad'))
    <script>
        Swal.fire({
            title: "Informacion",
            text: "{{ session('resGuardarIncapacidad') }}",
            icon: "success"
        });
    </script>  
    @endif

@endsection