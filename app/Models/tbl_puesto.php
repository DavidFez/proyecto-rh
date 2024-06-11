<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_puesto extends Model
{
    use HasFactory;

    protected $table = 'tbl_puestos';
    protected $primaryKey = 'idPuesto';
    protected $fillable = [
        'nombrePuesto',
        'descripPuesto',
        'competencias',
        'responsabilidades',
        'requisitos',
        'idDepartamento',
    ];

      public function departamento()
      {
         return $this->belongsTo(tbl_departamento::class, 'idDepartamento');
      }
}
