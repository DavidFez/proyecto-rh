@extends('dashboard')
@section('titulo', '- Crear Cargo')

@section('contenido')

    <div class="container">

        <br>
        <h2>Ingresar Cargo</h2>
        <hr>
        <br>

        <form action="{{ route('nominaGuardarCargo') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nombre del Cargo</label>
                <input name="nombreCargo" type="text" class="form-control" placeholder="Encargado cocina">
            </div>
    
            <div class="col-sm-10">
                <label for="exampleFormControlInput1" class="form-label">Salario</label>
                <input name="salarioCargo" type="number" class="form-control" placeholder="365.00" step="0.01" min="0">
            </div>
            
            <br>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Descripcion del cargo</label>
                <textarea name="descripcionCargo" class="form-edit" id="editor" cols="30" rows="50"></textarea>
    
                <script>
                    ClassicEditor
                        .create( document.querySelector( '#editor' ) )
                        .catch( error => {
                            console.error( error );
                        } );
                </script>
                
            </div>

            <button type="submit" class="btn btn-primary">Guardad</button>
            <a href="{{ route('verGestionCargos') }}" class="btn btn-secondary">Cancelar</a>

        </form>


    </div>
@endsection