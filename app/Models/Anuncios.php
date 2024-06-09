<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncios extends Model
{
    use HasFactory;

    protected $table = 'tbl_anuncios'; //Asociacion de la tabla con esta variable

    //MOdelo que sirve como plantilla al controlador para poder insertar los datos
    //ojo tinee que tener el nombre de las columnas que se quieren afectar
    protected $fillable = [
        'titulo',
        'cuerpo',
        'rutaArchivo',
        'fechaPublicacion',
        'fechaExpiracion',
    ];
}