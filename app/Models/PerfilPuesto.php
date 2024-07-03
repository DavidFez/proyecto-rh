<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilPuesto extends Model
{
    use HasFactory;

    protected $table = 'tbl_perfilPuesto'; // Asegúrate de que este sea el nombre correcto de la tabla en tu base de datos
    protected $primaryKey = 'idPerfilPuesto'; // Ajusta el nombre de la clave primaria si es necesario
    protected $fillable = [
        'edad',
        'sexo',
        'estadoCivil',
        'escolaridad',
        'residenciaPreferente',
        'nacionalidad',
        'idiomas',
        'disponibilidad',
        'conocimientosEspecificos',
        'experienciasPrevias',
        'caracteristicasHabilidades',
        'idDescpPuesto',
    ];

    
    public function departamento()
    {
        return $this->belongsTo(DescriptorPuesto::class, 'idDescpPuesto');
    }
}
