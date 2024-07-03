@extends('dashboard')
@section('titulo', '- Agregar Empleado')

@section('contenido')

    <div class="container">

        <br>
        <h2>Editar Datos del empleado</h2>
        <hr>
        <br>

        <form action="{{route('registrarNewDatosEmpleado', $editEmpleado->idEmpleado)}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nombres</label>
                <input type="text" class="form-control" name="editNombreEmpleado" value="{{$editEmpleado->nombres}}">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="editApellidoEmpleado" value="{{$editEmpleado->apellidos}}">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Cargo</label>
                <select name="editCargo" class="form-select" aria-label="Default select example">
                    <option selected value="{{$editEmpleado->datosCargo->idCargo}}">{{$editEmpleado->datosCargo->nombreCargo}}</option>
                    @foreach ($cargosDispo as $cargo)
                        <option value="{{$cargo->idCargo}}">{{$cargo->nombreCargo}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Direccion</label>
                <input type="text" class="form-control" name="editDireccion" value="{{$editEmpleado->direccion}}">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Telefono</label>
                <input type="text" class="form-control" name="editTelefono" value="{{$editEmpleado->telefono}}">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Correo</label>
                <input type="text" class="form-control" name="editCorreo" value="{{$editEmpleado->correo}}">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">DUI</label>
                <input type="text" class="form-control" name="editDui" value="{{$editEmpleado->dui}}">
            </div>

            <div class="mb-3">
                <label for="exampleDataList" class="form-label">Banco de deposito</label>
                <input name="editBanco" class="form-control" list="datalistOptions" id="exampleDataList" value="{{$editEmpleado->banco}}">
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
                <input type="text" class="form-control" name="editCuenta" value="{{$editEmpleado->cuentaDeposito}}">
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="{{ route('nominaGestionEmpleados') }}" class="btn btn-secondary">Cancelar</a>

        </form>

    </div>
    
@endsection