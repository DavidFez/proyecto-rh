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
        Schema::create('tbl_bonificaciones', function (Blueprint $table) {
            $table->id('idBonificacion');
            $table->unsignedBigInteger('idEmpleado');
            $table->string('bonificacion', 255);
            $table->float('monto');
            $table->date('fechaBonificacion');
            $table->timestamps();

            $table->foreign('idEmpleado')->references('idEmpleado')->on('tbl_empleado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_bonificaiones');
    }
};
