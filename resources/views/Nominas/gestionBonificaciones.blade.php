@extends('dashboard')
@section('titulo', '- Bonificaciones')

@section('contenido')

    <div class="container">

        <h2>Bonificaciones</h2>
        <hr>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">+ Agregar Bonificaion a empleado</button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Asignar Bonificaion a empleado</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Empleado:</label>
                                <select name="empleado" class="form-select" aria-label="Default select example">
                                    <option selected>Seleccione un empleado</option>
                                    @foreach ($bonificacionEmpleado as $empleado)
                                        <option value="{{$empleado->idEmpleado}}">{{$empleado->nombres}} {{$empleado->apellidos}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Concepto Bonificación:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Monto Bonificación:</label>
                                <input type="number" class="form-control" name="montoBonificacion" placeholder="150.00" step="0.01" min="0">
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


    </div>


@endsection