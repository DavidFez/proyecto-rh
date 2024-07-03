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
        Schema::create('tbl_ausencias_justificadas', function (Blueprint $table) {

            $table->id('idAusenciaJus');
            $table->unsignedBigInteger('idEmpleado');
            $table->date('fecha');
            $table->string('motivoJustificado', 255)->nullable();
            $table->timestamps();

            $table->foreign('idEmpleado')->references('idEmpleado')->on('tbl_empleado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_ausencias_justificadas');
    }
};
