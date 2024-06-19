<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id('id_evaluacion');
            $table->unsignedBigInteger('idEmpleado'); 

            $table->foreign('idEmpleado')->references('idEmpleado')->on('tbl_empleado')->onDelete('cascade');

            $table->string('rol');
            $table->string('departamento');
            $table->date('fecha_evaluacion');
            $table->string('evaluador');
            $table->integer('nota');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluaciones');
    }
};