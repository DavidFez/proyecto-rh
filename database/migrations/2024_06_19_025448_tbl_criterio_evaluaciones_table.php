<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_criterios_evaluacion', function (Blueprint $table) {
            $table->id('id_criterio'); // Clave primaria
            $table->unsignedBigInteger('id_evaluacion'); // Define la columna para la clave foránea

            // Agrega la clave foránea que referencia a 'id_evaluacion' en la tabla 'evaluaciones'
            $table->foreign('id_evaluacion')->references('id_evaluacion')->on('evaluaciones')->onDelete('cascade');

            $table->string('criterio');
            $table->text('descripcion');
            $table->integer('escala');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_criterios_evaluacion');
    }
};
