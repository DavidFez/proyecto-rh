@extends('dashboard')
@section('titulo', '- Horas Extras')

@section('contenido')
    
    <div class="container">

        <div class="row">
            <div class="col-9">
                <br><br>
                <h2>Gestion de Horas Extras</h2>
                <hr>
            </div>

            <div class="col-4">

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Registrar Horas extas
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Registro De Horas Extra</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <form action="{{route('registroHorasExtra')}}" class="fomrRegistroHorasExtra" action="" method="POST">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Empleado:</label>
                                        <select name="empleadoHoraExtra" class="form-select" aria-label="Default select example">
                                            <option selected>Seleccione un empleado</option>
                                            @foreach ($listaEmpleados as $empleado)
                                                <option value="{{$empleado->idEmpleado}}">{{$empleado->nombres}} {{$empleado->apellidos}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Fecha:</label>
                                        <input type="date" class="form-control" name="fechaHoraExtra">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Hora de inicio de hora extra:</label>
                                        <input type="time" class="form-control" name="horaIniHoraExtra" onchange="calcularHorasExtra()">
                                    </div>

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Hora final de horas extra:</label>
                                        <input type="time" class="form-control" name="horaFinHoraExtra" onchange="calcularHorasExtra()">
                                    </div>
                        
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Total horas extra</label>
                                        <input name="totalHoraExtra" type="number" class="form-control" min="0">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Registrar Horas Extras</button>
                                    </div>

                                </form>

                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>


            <div class="col-6">.col-6<br>En esta parte, algo más que se me ocurra</div>
        </div>

    </div>

    @if (Session::has('resGuardarHoraExtra'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resGuardarHoraExtra') }}",
                icon: "success"
            });
        </script>  
    @endif

@endsection

@section('jsVistasAdmin')
    <script>
        function calcularHorasExtra() {
            const horaInicio = document.querySelector('input[name="horaIniHoraExtra"]').value;
            const horaFin = document.querySelector('input[name="horaFinHoraExtra"]').value;

            if (horaInicio && horaFin) {
                const inicio = new Date(`1970-01-01T${horaInicio}:00`);
                const fin = new Date(`1970-01-01T${horaFin}:00`);

                let diferencia = (fin - inicio) / 1000 / 60 / 60; // Diferencia en horas

                if (diferencia < 0) {
                    diferencia += 24; // Ajuste si la hora de fin es al día siguiente
                }

                document.querySelector('input[name="totalHoraExtra"]').value = diferencia;
            }
        }
    </script>

    <script>

        $('.fomrRegistroHorasExtra').on('submit', function(e){
            
            e.preventDefault();
            Swal.fire({
                title: "¿Está seguro?",
                text: "Asegurese se que se haya ingresado los datos correspondientes",
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