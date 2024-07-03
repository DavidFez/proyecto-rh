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
            $table->string('empleado');
            $table->string('cargo');
            $table->decimal('salarioBruto', 8, 2);
            $table->decimal('afp', 8, 2);
            $table->decimal('isss', 8, 2);
            $table->decimal('renta', 8, 2);
            $table->decimal('otro', 8, 2)->nullable();
            $table->decimal('aguinaldo', 8, 2)->nullable();
            $table->decimal('totalDescuento', 8, 2)->nullable();
            $table->decimal('salarioNeto', 8,2);
            $table->text('boleta')->nullable();
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
