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
        Schema::create('tbl_vacaciones', function (Blueprint $table) {
            $table->id('idVacacion');
            $table->unsignedBigInteger('idEmpleado');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->integer('totalDias');
            $table->float('montoVacaciones');
            $table->string('comentario')->nullable();
            $table->timestamps();
            $table->foreign('idEmpleado')->references('idEmpleado')->on('tbl_empleado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_vacaciones');
    }
};
