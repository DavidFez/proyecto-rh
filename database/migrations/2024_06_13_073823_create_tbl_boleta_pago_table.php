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
        Schema::create('tbl_boleta_pago', function (Blueprint $table) {
            $table->id('idBoleta');
            $table->date('fechaRegistro');
            $table->date('fechaIncorporacion')->nullable();
            $table->string('nombreEmpleado', 255);
            $table->string('cargo', 255);
            $table->decimal('salarioCargo', 8, 2);
            $table->string('periodoLaborado', 100);
            $table->integer('diasLaborados');
            $table->integer('diasDescanso')->nullable();
            $table->string('metodoPago', 100)->nullable();
            $table->string('cuentaPago', 100)->nullable();
            $table->date('fechaPago');
            $table->string('periodoVacaciones', 100)->nullable();
            $table->decimal('cargoVacaciones', 8, 2)->nullable();
            $table->string('periodoIncapacidad', 100)->nullable();
            $table->integer('asistenciaJus')->nullable();
            $table->integer('asistenciaInjus')->nullable();
            $table->decimal('salarioBruto', 8, 2);
            $table->decimal('isss', 8, 2)->nullable();
            $table->decimal('afp', 8, 2)->nullable();
            $table->decimal('renta', 8, 2)->nullable();
            $table->decimal('totalDescuentos', 8, 2)->nullable();
            $table->string('bonoConcepto')->nullable();
            $table->decimal('bonificacion', 8, 2)->nullable();
            $table->decimal('salarioNeto', 8, 2);
            $table->integer('id_empleado')->nullable();
            $table->text('archivoBoleta'); //campo de la ruta del pdf del archivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_boleta_pago');
    }
};
