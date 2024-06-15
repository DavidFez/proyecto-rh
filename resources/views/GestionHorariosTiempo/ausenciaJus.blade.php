@extends('dashboard')
@section('titulo', '- Gestion Ausencias Justificadas')

@section('contenido')

    <div class="container">
        <br>
        <h2>Ausencias Justificadas</h2>
        <hr>
        <br>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">+ Registrar una ausencia con justificacion</button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar una ausencia justificada</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="{{route('guardarAsenciasJustificadas')}}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Empleado:</label>
                                <select name="ausenciaJusEmpleado" class="form-select" aria-label="Default select example">
                                    <option selected>Seleccione un empleado</option>
                                    @foreach ($auseniaJus as $empleado)
                                        <option value="{{$empleado->idEmpleado}}">{{$empleado->nombres}} {{$empleado->apellidos}}</option>
                                    @endforeach
                                </select>
                            </div>

                            
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Fecha de ausencia:</label>
                                <input type="date" class="form-control" name="fechaAusenciaJus">
                            </div>

                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Justificacion:</label>
                                <textarea name="motivoAusenciaJus" class="form-control" id="message-text"></textarea>
                            </div>
                            
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Registrar ausencia</button>
                            </div>

                        </form>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>

    @if (Session::has('resGuardarAusenciaJus'))
    <script>
        Swal.fire({
            title: "Informacion",
            text: "{{ session('resGuardarAusenciaJus') }}",
            icon: "success"
        });
    </script>  
    @endif

@endsection