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
        Schema::create('tbl_empleado', function (Blueprint $table) {
            $table->id('idEmpleado');
            $table->unsignedBigInteger('idCargo');
            $table->string('nombres', 150);
            $table->string('apellidos', 150);
            $table->string('direccion');
            $table->date('fechaNacimiento');
            $table->string('telefono', 15);
            $table->string('correo', 100)->nullable();
            $table->string('dui', 12);
            $table->date('fechaIncorporacion');
            $table->text('cv')->nullable();
            $table->string('cuentaDeposito')->nullable();
            $table->string('banco')->nullable();
            $table->timestamps();

            $table->foreign('idCargo')->references('idCargo')->on('tbl_cargo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_empleado');
    }
};
