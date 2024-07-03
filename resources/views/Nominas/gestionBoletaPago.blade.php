@extends('dashboard')
@section('titulo', '- Boletas de Pago')

@section('contenido')
    <div class="container">
        <br><br>
        <h2>Generar Listado de Boletas de Pago</h2>

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
                    <form method="POST" action="{{route('verBoletasLista')}}">
                        @csrf
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <input name="buscarBoleta1" type="date" class="form-control" placeholder="Fecha Inicial" style="width: 200px;">
                                </th>
                                <td>
                                    <input name="buscarBoleta2" type="date" class="form-control" placeholder="Fecha Final" style="width: 200px;">
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
@endsection