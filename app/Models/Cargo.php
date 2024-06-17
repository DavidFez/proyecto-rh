<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;
    protected $table = "tbl_cargo";
    protected $primaryKey = 'idCargo';

    protected $fillable = [
        'nombreCargo',
        'descripcionCargo',
        'salario'
    ];

    public function empleados(){

        return $this->hasMany(Empleado::class, 'idCargo', 'idCargo');

    }
    
}
