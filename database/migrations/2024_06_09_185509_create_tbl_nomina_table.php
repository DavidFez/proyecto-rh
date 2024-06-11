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
            $table->unsignedBigInteger('idEmpleado');
            $table->timestamp('fechaHora');
            $table->decimal('afp', 8,2)->nullable();
            $table->decimal('isss', 8, 2)->nullable();
            $table->decimal('insa', 8, 2)->nullable();
            $table->unsignedBigInteger('idBeneficio')->nullable();
            $table->decimal('totalDisponer', 8,2);
            $table->timestamps();

            $table->foreign('idEmpleado')
            ->references('idEmpleado')
            ->on('tbl_empleado');


            $table->foreign('idBeneficio')
            ->references('idBeneficio')
            ->on('tbl_beneficio_economico');
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
