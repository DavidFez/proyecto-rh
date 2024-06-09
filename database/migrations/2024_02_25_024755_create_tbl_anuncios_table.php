<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_anuncios', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 500);
            $table->text('cuerpo')->nullable();
            $table->text('rutaArchivo')->nullable();
            $table->date('fechaPublicacion');
            $table->date('fechaExpiracion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_anuncios');
    }
};
