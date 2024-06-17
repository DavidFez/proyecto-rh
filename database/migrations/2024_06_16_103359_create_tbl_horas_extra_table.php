<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_horas_extra', function (Blueprint $table) {
            $table->id('idHoraExtra');
            $table->unsignedBigInteger('idEmpleado');
            $table->date('fecha');
            $table->time('horaInicio')->nullable();
            $table->time('horaFin')->nullable();
            $table->integer('totalHorasExtra')->nullable();
            $table->float('montoHorasExtra')->nullable();
            $table->timestamps();

            $table->foreign('idEmpleado')->references('idEmpleado')->on('tbl_empleado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_horas_extra');
    }
};
