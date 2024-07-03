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
                <div class="modal-content bg-secondary text-white">
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
                                <label for="fechaInicioIcapaciadad" class="form-label">Fecha de inicio de incapacidad:</label>
                                <input type="date" class="form-control" id="fechaInicioIcapaciadad" name="fechaInicioIcapaciadad" onchange="calcularDiasIncapacidad()">
                            </div>
                        
                            <div class="mb-3">
                                <label for="fechaFinIncapacidad" class="form-label">Fecha fin de incapacidad:</label>
                                <input type="date" class="form-control" id="fechaFinIncapacidad" name="fechaFinIncapacidad" onchange="calcularDiasIncapacidad()">
                            </div>
                        
                            <div class="mb-3">
                                <label for="diasIncapaciodad" class="form-label">Días de incapacidad:</label>
                                <input type="number" class="form-control" id="diasIncapaciodad" name="diasIncapaciodad" readonly>
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

@section('jsVistasAdmin')
    
    <script>
        function calcularDiasIncapacidad() {
            // Obtener las fechas desde los inputs
            const fechaInicio = document.getElementById('fechaInicioIcapaciadad').value;
            const fechaFin = document.getElementById('fechaFinIncapacidad').value;

            // Si ambas fechas están presentes, calcular diferencia en días
            if (fechaInicio && fechaFin) {
                const fechaInicioMs = new Date(fechaInicio).getTime();
                const fechaFinMs = new Date(fechaFin).getTime();

                const diferenciaMs = fechaFinMs - fechaInicioMs;
                const diasIncapacidad = (diferenciaMs / (1000 * 60 * 60 * 24) + 1); // Convertir a días

                // Mostrar el resultado en el input de días de incapacidad
                document.getElementById('diasIncapaciodad').value = diasIncapacidad;
            } else {
                // Si falta alguna fecha, mostrar 0 o mensaje de error según tu lógica
                document.getElementById('diasIncapaciodad').value = '';
            }
        }
    </script>

@endsection