@extends('dashboard')
@section('titulo', '- Asignar Vacaciones')

@section('contenido')

    <div class="container">

        <br>
        <h2>Asignar Vaciones a un empleado</h2>
        <hr>
        <br>

        <form action="{{route('guardarVacaciones')}}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Empleado:</label>
                <select name="vacacionEmpleado" class="form-select" aria-label="Default select example">
                    <option selected>Seleccione un empleado</option>
                    @foreach ($empleadoVacacion as $empleado)
                        <option value="{{$empleado->idEmpleado}}">{{$empleado->nombres}} {{$empleado->apellidos}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Fecha de inicio de vacacion:</label>
                <input type="date" class="form-control" name="vacacionInicio">
            </div>
            
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Fecha fin de vacion:</label>
                <input type="date" class="form-control" name="vacacionFin">
            </div>

            <div class="col-sm-10">
                <label for="exampleFormControlInput1" class="form-label">Total de días</label>
                <input name="diasDeVacion" type="number" class="form-control" min="0">
            </div>

            <div class="mb-3">
                <label for="message-text" class="col-form-label">Comentarios a agregar:</label>
                <textarea name="comentarioVacacion" class="form-control" id="message-text"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('gestionVacaciones') }}" class="btn btn-secondary">Cancelar</a>

        </form>

    </div>
    
@endsection