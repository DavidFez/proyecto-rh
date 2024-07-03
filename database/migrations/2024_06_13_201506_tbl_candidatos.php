<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_candidatos', function (Blueprint $table) {
            $table->id('idCandidato');
            $table->string('nombre');
            $table->string('correo')->unique();
            $table->string('telefono');
            $table->string('direccion');
            $table->string('curriculum')->nullable(); // Para almacenar el nombre del archivo PDF del curriculum
            $table->string('dui')->nullable(); // Para almacenar el nombre del archivo PDF del DUI
            $table->string('estado')->nullable();
            $table->string('nombreEvaluador')->nullable(); // Nombre del evaluador
            $table->string('resultadoEvaluacion')->nullable();
            $table->text('comentarios')->nullable();
            $table->integer('puntajePruebaTecnica')->default(0);
            $table->integer('puntajePruebaEntrevista')->default(0);
            $table->integer('puntajeCV')->default(0);
            $table->boolean('estadoEvaluacionCV')->default(false);
            $table->boolean('estadoPruebaTecnica')->default(false);
            $table->boolean('estadoPruebaEntrevista')->default(false);
            $table->unsignedBigInteger('puesto_aplicado_id'); // Referencia a la tabla de puestos
            $table->timestamps();

            $table->foreign('puesto_aplicado_id')->references('idDescpPuesto')->on('tbl_descriptorPuestos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('candidatos');
    }
};
