@extends('dashboard')
@section('titulo', '- Incio') 

@section('contenido')
    <?php

        date_default_timezone_set('America/Mexico_City');
        $horaActual = date('G'); // Obtenemos la hora actual en formato de 24 hora


        if ($horaActual >= 5 && $horaActual < 12) {
            $mensaje = "¡Buenos días!";
        } 
        elseif ($horaActual >= 12 && $horaActual < 18) {
            $mensaje = "¡Buenas tardes!";
        } 
        else {
            $mensaje = "¡Buenas noches!";
        }
    ?>
    <h1> {{$mensaje}} </h1>
    <h2>¡Bienvenid@ de nuevo @auth {{Auth::user()->name}}! 👋 @endauth</h2>

@endsection