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
        Schema::create('tbl_nomina', function (Blueprint $table) {
            $table->id('idNomina');
            $table->date('fechaRegistro');
            $table->date('fecha1');
            $table->date('fecha2');
            $table->string('nombreEmpleado', 255);
            $table->string('cargo', 255);
            $table->decimal('salarioCargo', 8, 2);
            $table->integer('diasLaborados');
            $table->integer('diasDescanso')->nullable();
            $table->string('periodoVacaciones',100)->nullable();
            $table->decimal('cargoVacaciones', 8, 2)->nullable();
            $table->string('periodoIncapacidad', 100)->nullable();
            $table->integer('asistenciaJus')->nullable();
            $table->integer('asistenciaInjus')->nullable();
            $table->decimal('salarioBruto', 8, 2);
            $table->decimal('isss', 8, 2)->nullable();
            $table->decimal('afp', 8, 2)->nullable();
            $table->decimal('insa', 8, 2)->nullable();
            $table->string('bonoConcepto')->nullable();
            $table->decimal('bonificacion', 8, 2)->nullable();
            $table->decimal('totalDisponer', 8, 2);
            $table->integer('id_empleado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_nomina');
    }
};
