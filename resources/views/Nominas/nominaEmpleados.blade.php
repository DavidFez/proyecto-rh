@extends('dashboard')
@section('titulo', '- Nomina')

@section('contenido')
    <div class="container">
        <br><br>

        <h2>Ingresar a la nomina</h2>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Empleado</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                @php
                    $numero = 1 
                @endphp

                @foreach ($nominaEmpleados as $empleado)

                    <tr>
                        <th scope="row">{{$numero}}</th>
                        <td>{{$empleado->nombres}} {{$empleado->apellidos}}</td>
                        <td>{{$empleado->cargo->nombreCargo}}</td>
                        <td>+503 {{$empleado->telefono}}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$numero}}" data-bs-whatever="@getbootstrap">+ Agregar a nomina mensual</button>
                        </td>
                    </tr>

                    @php
                        $numero++
                    @endphp
                @endforeach

                
            </tbody>

        </table>

        @php
            $contador = 1;
        @endphp
        @foreach ($nominaEmpleados as $item)

            <div class="modal fade" id="exampleModal{{$contador}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ingrese el rango de fechas</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="{{route('verTablaNomina')}}" method="POST">
                                @csrf

                                <input type="hidden" name="idEmpleado" value="{{$item->idEmpleado}}">

                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Empleado: {{$item->nombres}} {{$item->apellidos}}</label>
                                </div>

                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Fecha 1:</label>
                                    <input type="date" class="form-control" name="nominaFecha1">
                                </div>

                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Fecha 2:</label>
                                    <input type="date" class="form-control" name="nominaFecha2">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Ingresar a la nomina</button>
                                </div>

                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>

            @php
                $contador++;
            @endphp
        @endforeach

        <br><br>
        <h2>Generar Nomina Mensual</h2>

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
                    <form method="POST" action="">
                        @csrf
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <input name="fecha1Nomina" type="date" class="form-control" placeholder="Fecha Inicial" style="width: 200px;">
                                </th>
                                <td>
                                    <input name="fecha2Nomina" type="date" class="form-control" placeholder="Fecha Final" style="width: 200px;">
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
        
@endsection
    