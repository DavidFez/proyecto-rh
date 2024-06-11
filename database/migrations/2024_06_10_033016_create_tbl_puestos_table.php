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
        Schema::create('tbl_puestos', function (Blueprint $table) {
            $table->id('idPuesto');
            $table->string('nombrePuesto');
            $table->text('descripPuesto')->nullable();
            $table->text('competencias')->nullable();
            $table->text('responsabilidades')->nullable();
            $table->text('requisitos')->nullable();
            $table->timestamps();
            
            $table->foreignId('idDepartamento')
                  ->constrained('tbl_departamentos', 'idDepartamento') // Referenciando idDepartamento en tbl_departamentos
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_puestos');
    }
};
