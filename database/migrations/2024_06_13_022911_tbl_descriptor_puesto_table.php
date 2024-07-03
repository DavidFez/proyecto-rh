<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_descriptorPuestos', function (Blueprint $table) {
            $table->id('idDescpPuesto');
            $table->date('fechaElaboracion');
            $table->date('fechaRevision');
            $table->string('tituloPuesto');
            $table->string('operacionArea');
            $table->string('puestoAlQueReporta');
            $table->integer('directosCantidad');
            $table->integer('indirectosCantidad');
            $table->text('propositoPuesto');
            $table->text('funcionesPrincipales');
            $table->text('impactoDecisiones');
            $table->unsignedBigInteger('idDepartamento');
            $table->timestamps();

            $table->foreign('idDepartamento')->references('idDepartamento')->on('tbl_departamentos')->onDelete('cascade');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('tbl_descriptorPuestos');
    }
};
