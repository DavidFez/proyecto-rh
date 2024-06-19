@extends('dashboard')

@section('contenido')
<h1>Evaluaciones</h1>
<button type="button" class="btn btn-primary" onclick="window.location='{{ url("evaluaciones/create") }}'">Crear Nueva Evaluación</button>

<!-- Tabla de Evaluaciones -->
<table class="table">
    <thead>
        <tr>
            <th>Empleado</th>
            
            <th>Fecha de Evaluación</th>
            <th>Evaluador</th>
            <th>Nota (%)</th>
            <th>Observaciones</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($evaluaciones as $evaluacion)
        <tr>
            <td>{{ $evaluacion->empleado->nombres}}</td>
           
            
            <td>{{ $evaluacion->fecha_evaluacion }}</td>
            <td>{{ $evaluacion->evaluador }}</td>
            <td>{{ $evaluacion->nota }}</td>
            <td>{{ $evaluacion->observaciones }}</td>
            <!--
            <td>
                <a href="#" class="btn btn-info">Ver</a>
                <a href="#" class="btn btn-warning">Editar</a>
                <form action="#" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
              -->
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
