<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestacion extends Model
{
    use HasFactory;

    protected $table = "tbl_prestaciones_ley";
    protected $primaryKey = 'idPrestacion';

    //Perstacion del aguinaldo para esta tabla
    protected $fillable = [
        'tipoPrestacion',
        'prestacion',
        'porcentaje'
    ];
}
