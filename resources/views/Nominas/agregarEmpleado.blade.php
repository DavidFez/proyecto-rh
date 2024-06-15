@extends('dashboard')
@section('titulo', '- Agregar Empleado')

@section('contenido')

    <div class="container">

        <br>
        <h2>Agregar empleado</h2>
        <hr>
        <br>

        <form action="{{route('nominaGuardarEmpleado')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nombres</label>
                <input type="text" class="form-control" name="nombreEmpleado" placeholder="Juan José">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidoEmpleado" placeholder="Pérez Martínez">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Cargo</label>
                <select name="cargoEmpleado" class="form-select" aria-label="Default select example">
                    <option selected>Seleccione un cargo</option>
                    @foreach ($cargoTrabajador as $cargo)
                        <option value="{{$cargo->idCargo}}">{{$cargo->nombreCargo}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Direccion</label>
                <input type="text" class="form-control" name="direccionEmpleado" placeholder="Colonia El Magon, San Miguel">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Fecha Nacimiento</label>
                <input name="fechaNacimientoEmpleado" type="date" class="form-control">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Telefono</label>
                <input type="text" class="form-control" name="telefonoEmpleado" placeholder="7555-3443">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Correo</label>
                <input type="text" class="form-control" name="correoEmpleado" placeholder="name@example.com">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">DUI</label>
                <input type="text" class="form-control" name="duiEmpleado" placeholder="23451212-3">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Fecha de ingreso a la empresa</label>
                <input type="date" class="form-control" name="fechaIngresoEmpelado">
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Subir curriculum</label>
                <input class="form-control" type="file" name="cvEmpleado">
            </div>

            <div class="mb-3">
                <label for="exampleDataList" class="form-label">Banco de deposito</label>
                <input name="bancoEmpleado" class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Seleccionar Banco">
                <datalist id="datalistOptions">
                    <option value="Banco Agricola, S.A."></option>
                    <option value="Banco Cuscatlan de El Salvador, S.A"></option>
                    <option value="Banco Davivienda Salvadoreño, S.A."></option>
                    <option value="Banco Hipotecario de El Salvador, S.A"></option>
                    <option value="Citibank, N.A., Sucursal El Salvador"></option>
                    <option value="Banco de Fomento Agropecuario"></option>
                    <option value="Banco Promerica, S.A."></option>
                    <option value="Banco de America Central, S.A."></option>
                    <option value="Banco ABANK, S.A."></option>
                    <option value="Banco Industrial El Salvador, S.A."></option>
                    <option value="Banco Azul de El Salvador, S.A."></option>
                    <option value="Banco Atlantida El Salvador, S.A.."></option>
                </datalist>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Cuenta de deposito</label>
                <input type="text" class="form-control" name="cuentaEmpleado" placeholder="0342123456">
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('nominaGestionEmpleados') }}" class="btn btn-secondary">Cancelar</a>

        </form>

    </div>
    
@endsection