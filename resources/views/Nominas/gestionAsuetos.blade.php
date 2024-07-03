@extends('dashboard')
@section('titulo', '- Gestion Asuetos')

@section('contenido')
    
    <div class="container">

        <div class="row">
            <div class="col-9">
                <br><br>
                <h2>Gestion de Asuetos</h2>
                <hr>
            </div>

            <div class="col-4">

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Registrar asueto laborado
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-secondary text-white">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Registro De Asueto</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <form action="{{route('asuetoRegistrar')}}" class="formRegistrarAsueto" method="POST">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Empleado:</label>
                                        <select name="empleadoAsueto" class="form-select" aria-label="Default select example">
                                            <option selected>Seleccione un empleado</option>
                                            @foreach ($empleadoAuetos as $empleado)
                                                <option value="{{$empleado->idEmpleado}}">{{$empleado->nombres}} {{$empleado->apellidos}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Fecha Asueto:</label>
                                        <input type="date" class="form-control" name="fechaAsueto">
                                    </div>

                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Descripcion del asueto *Opcional:</label>
                                        <textarea name="diaAsueto" class="form-control" id="message-text"></textarea>
                                    </div>
                                    
                                    <label for="recipient-name" class="col-form-label"><h3>Horas extras el dia de asueto</h3></label>

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Hora de inicio de hora extra:</label>
                                        <input type="time" class="form-control" name="asuetoHoraInicio" onchange="calcularHorasExtra()">
                                    </div>

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Hora final de horas extra:</label>
                                        <input type="time" class="form-control" name="asuetoHoraFin" onchange="calcularHorasExtra()">
                                    </div>
                        
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Total horas extra</label>
                                        <input name="asuetoTotalHora" type="number" class="form-control" min="0">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Registrar Asueto</button>
                                    </div>

                                </form>

                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>

        </div>


        <br>
        <br>
        <h2>Revisar Horas Extras Mensuales</h2>

        <div class="col-12">
            <div class="p-3 m-1"> <!--Padding y margin del texto-->           
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">Fecha Inicial</th>
                        <th scope="col">Fecha Final</th>
                        <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <form method="POST" action="{{route('listAsuetos')}}">
                        @csrf
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <input name="fecha1Asueto" type="date" class="form-control" placeholder="Fecha Inicial" style="width: 200px;">
                                </th>
                                <td>
                                    <input name="fecha2Asueto" type="date" class="form-control" placeholder="Fecha Final" style="width: 200px;">
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-secondary" id="btnGenerarInforme">Generar Informe</button>
                                </td>
                            </tr>
                        </tbody>
                    </form>
                </table>
            </div>
        </div>

    </div>

    @if (Session::has('resGuardarAsueto'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('resGuardarAsueto') }}",
                icon: "success"
            });
        </script>  
    @endif

@endsection

@section('jsVistasAdmin')
    <script>
        function calcularHorasExtra() {
            const horaInicio = document.querySelector('input[name="asuetoHoraInicio"]').value;
            const horaFin = document.querySelector('input[name="asuetoHoraFin"]').value;

            if (horaInicio && horaFin) {
                const inicio = new Date(`1970-01-01T${horaInicio}:00`);
                const fin = new Date(`1970-01-01T${horaFin}:00`);

                let diferencia = (fin - inicio) / 1000 / 60 / 60; // Diferencia en horas

                if (diferencia < 0) {
                    diferencia += 24; // Ajuste si la hora de fin es al día siguiente
                }

                document.querySelector('input[name="asuetoTotalHora"]').value = diferencia;
            }
        }
    </script>

    <script>

        $('.formRegistrarAsueto').on('submit', function(e){
            
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