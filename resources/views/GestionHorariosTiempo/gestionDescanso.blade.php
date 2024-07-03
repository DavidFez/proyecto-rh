@extends('dashboard')
@section('titulo', '- Descanso')

@section('contenido')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                select: function(info) {
                    $('#selectedDate').val(info.startStr);
                    $('#assignWorkerModal').modal('show');
                },
                events: [
                    @foreach ($diasDescanso as $asistencia)
                        {
                            title: '{{$asistencia->empleado->nombres}} {{$asistencia->empleado->apellidos}}',
                            start: '{{$asistencia->fecha}}',
                            color: 'green', // Puedes personalizar el color si lo deseas
                        },
                    @endforeach
                ]
            });

            calendar.render();
        });

    </script>

    <div class="container">
        <h2>Gestion de Descansos</h2>
        <hr>
        <div class="container text-center">
            <div class="row">
                <div class="col-sm-12">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="assignWorkerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-secondary text-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Descanso</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="{{route('registroDescanso')}}" method="POST" id="assignWorkerForm">
                        @csrf
                        <div class="form-group">
                            <label for="worker">Seleccionar Trabajador</label>
                            <select id="worker" name="descansoEmpleado" class="form-control">
                                <option selected>Seleccione un empleado</option>
                                    @foreach ($empleadosDescanso as $empleado)
                                        <option value="{{$empleado->idEmpleado}}">{{$empleado->nombres}} {{$empleado->apellidos}}</option>
                                    @endforeach
                            </select>
                        </div>

                        <!-- Campo oculto para la fecha seleccionada -->
                        <input type="hidden" id="selectedDate" name="selectedDate">

                        <br><br>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Registrar Descanso</button>
                        </div>
                        
                    </form>

                </div>

            </div>
        </div>
    </div>

    @if (Session::has('resGuardarDescanso'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resGuardarDescanso') }}",
                icon: "success"
            });
        </script>  
    @endif



@endsection

@section('jsVistasAdmin')

@endsection