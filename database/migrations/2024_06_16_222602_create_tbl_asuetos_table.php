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
        Schema::create('tbl_asuetos', function (Blueprint $table) {
            $table->id('idAsueto');
            $table->unsignedBigInteger('idEmpleado');
            $table->date('fecha');
            $table->string('asueto', 100)->nullable();
            $table->time('horaInicio')->nullable();
            $table->time('horaFin')->nullable();
            $table->integer('horasExtra')->nullable();
            $table->float('totalAsueto')->nullable();
            $table->timestamps();

            $table->foreign('idEmpleado')->references('idEmpleado')->on('tbl_empleado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_asuetos');
    }
};
