@extends('dashboard')
@section('titulo', '- Editar Cargo')

@section('contenido')

    <div class="container">

        <br>
        <h2>Editar Cargo</h2>
        <hr>
        <br>

        <form action="{{ route('guardarEditCargo', $editCargo->idCargo) }}" method="POST">
            @csrf
            <div class="col-sm-6">
                <label for="exampleFormControlInput1" class="form-label">Nombre del Cargo</label>
                <input value="{{$editCargo->nombreCargo}}" name="editarCargo" type="text" class="form-control">
            </div>
    
            <div class="col-sm-6">
                <label for="exampleFormControlInput1" class="form-label">Salario</label>
                <input value="{{$editCargo->salario}}" name="editarSalarioCargo" type="number" class="form-control" step="0.01" min="0">
            </div>
            
            <br>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Descripcion del cargo</label>
                <textarea name="editarDescripCargo" id="editor" cols="30" rows="50">{{$editCargo->descripcionCargo}}</textarea>
    
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