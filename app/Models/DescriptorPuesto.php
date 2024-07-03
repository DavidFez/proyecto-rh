<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescriptorPuesto extends Model
{
    use HasFactory;

    protected $table = 'tbl_descriptorPuestos';
    protected $primaryKey = 'idDescpPuesto';
    protected $fillable = [
        'fechaElaboracion',
        'fechaRevision',
        'tituloPuesto',
        'operacionArea',
        'puestoAlQueReporta',
        'directosCantidad',
        'indirectosCantidad',
        'propositoPuesto',
        'funcionesPrincipales',
        'impactoDecisiones',
        'idDepartamento',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'idDepartamento');
    }
}