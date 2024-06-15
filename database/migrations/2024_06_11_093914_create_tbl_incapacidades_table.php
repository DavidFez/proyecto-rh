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
        Schema::create('tbl_incapacidades', function (Blueprint $table) {

            $table->id('idIncapacidad');
            $table->unsignedBigInteger('idEmpleado');
            $table->date('fechaRegistro');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->string('motivo', 255);
            $table->text('constancia')->nullable(); // esto es para almacenar una ruta
            $table->timestamps();

            $table->foreign('idEmpleado')->references('idEmpleado')->on('tbl_empleado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_incapacidades');
    }
};
