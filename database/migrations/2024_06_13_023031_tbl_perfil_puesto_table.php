<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_perfilPuesto', function (Blueprint $table) {
            $table->id('idPerfilPuesto');
            $table->string('edad');
            $table->string('sexo');
            $table->string('estadoCivil');
            $table->string('escolaridad');
            $table->string('residenciaPreferente');
            $table->string('nacionalidad');
            $table->string('idiomas');
            $table->text('disponibilidad');
            $table->text('conocimientosEspecificos');
            $table->integer('experienciasPrevias');
            $table->text('caracteristicasHabilidades');
            $table->unsignedBigInteger('idDescpPuesto');
            $table->timestamps();

            $table->foreign('idDescpPuesto')->references('idDescpPuesto')->on('tbl_descriptorPuestos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_perfilPuesto');
    }
};
