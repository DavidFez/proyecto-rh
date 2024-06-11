<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_departamento extends Model
{
    use HasFactory;

    protected $table = 'tbl_departamentos'; //Asociacion de la tabla con esta variable
    protected $primaryKey = 'idDepartamento';
    protected $fillable = [
        'nombreDepto'
    ];
}
