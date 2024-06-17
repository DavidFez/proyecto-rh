@extends('dashboard')
@section('titulo', '- Inicio') 

@section('contenido')
    <?php

        date_default_timezone_set('America/Mexico_City');
        $horaActual = date('G'); // Obtenemos la hora actual en formato de 24 hora


        if ($horaActual >= 5 && $horaActual < 12) {
            $mensaje = "¡Buenos días!";
        } 
        elseif ($horaActual >= 12 && $horaActual < 18) {
            $mensaje = "¡BUENAS TARDES!";
        } 
        else {
            $mensaje = "¡Buenas noches!";
        }
    ?>
    <div class="centered-content">
        <h1>{{$mensaje}}</h1>
        <h1>¡BIENVENIDO DE NUEVO @auth {{Auth::user()->name}}! 👋 @endauth</h1>

    </div>

@endsection