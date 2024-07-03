<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_pruebasSeleccion', function (Blueprint $table) {
            $table->id('idPruebaSeleccion');
            $table->unsignedBigInteger('idCandidato');
            $table->unsignedBigInteger('idDescpPuesto');
            $table->string('nombreEvaluador');
            $table->text('Observacion')->nullable();
            $table->string('pruebaTecnica');
            $table->string('pruebaEntrevista');
            $table->timestamps();

            $table->foreign('idCandidato')->references('idCandidato')->on('tbl_candidatos')->onDelete('cascade');
            $table->foreign('idDescpPuesto')->references('idDescpPuesto')->on('tbl_descriptorPuestos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_pruebasSeleccion');
    }
};
