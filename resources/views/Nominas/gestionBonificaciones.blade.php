@extends('dashboard')
@section('titulo', '- Bonificaciones')

@section('contenido')

    <div class="container">

        <h2>Bonificaciones</h2>
        <hr>

        <button type="button" class="btn btn-insertar" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">+ Agregar Bonificaion a empleado</button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Asignar Bonificaion a empleado</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="{{route('nominaBonificacionGuardar')}}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Empleado:</label>
                                <select name="bonoEmpleado" class="form-select" aria-label="Default select example">
                                    <option selected>Seleccione un empleado</option>
                                    @foreach ($bonificacionEmpleado as $empleado)
                                        <option value="{{$empleado->idEmpleado}}">{{$empleado->nombres}} {{$empleado->apellidos}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Concepto Bonificación:</label>
                                <textarea name="bonoConcepto" class="form-control" id="message-text"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Monto Bonificación:</label>
                                <input type="number" class="form-control" name="boonoMnto" placeholder="150.00" step="0.01" min="0">
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Send message</button>
                            </div>

                        </form>
                    </div>
                    
                </div>
            </div>
        </div>

        <br><br><br>

        <h2>Ver bonificaciones otorgadas</h2>

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
                    <form method="POST" action="{{route('nominaBonificacionesOtorgadas')}}">
                        @csrf
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <input name="fecha1Bono" type="date" class="form-control" placeholder="Fecha Inicial" style="width: 200px;">
                                </th>
                                <td>
                                    <input name="fecha2Bono" type="date" class="form-control" placeholder="Fecha Final" style="width: 200px;">
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


    @if (Session::has('resGuardarBono'))
    <script>
        Swal.fire({
            title: "Informacion",
            text: "{{ session('resGuardarBono') }}",
            icon: "success"
        });
    </script>  
    @endif


@endsection