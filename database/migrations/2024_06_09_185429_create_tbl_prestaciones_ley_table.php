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
        Schema::create('tbl_prestaciones_ley', function (Blueprint $table) {
            $table->id('idPrestacion');
            $table->string('tipoPrestacion');
            $table->string('prestacion', 150);
            $table->float('porcentaje');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_prestaciones_ley');
    }
};
