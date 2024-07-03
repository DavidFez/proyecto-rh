<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_expedientes', function (Blueprint $table) {
        $table->id('idExpediente');
        $table->unsignedBigInteger('idEmpleado');
        $table->string('constancia_policia')->nullable(); // campo PDF de la constancia de policía
        $table->string('titulos_cursos')->nullable(); //campo  PDF de títulos o cursos
        $table->string('puesto_trabajo')->nullable(); // campo uesto de trabajo
        $table->string('departamento')->nullable(); // campo Departamento
        $table->string('estado_empleado')->nullable(); // campo para el stado del empleado (activo, inactivo, etccc..)
        $table->timestamps();
        
        $table->foreign('idEmpleado')->references('idEmpleado')->on('tbl_empleado')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('expedientes');
    }
};
