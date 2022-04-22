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
        Schema::create('asignaturas_tecnicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_docente');//atributo para referenciar a categoria
            $table->foreign('id_docente')->references('id')->on('docente');//llave foranea para referenciar a la tabla categorias
            $table->unsignedBigInteger('id_asignaturas');//atributo para referenciar a categoria
            $table->foreign('id_asignaturas')->references('id')->on('asignaturas');//llave foranea para referenciar a la tabla categorias
            $table->unsignedBigInteger('id_trimestre');//atributo para referenciar a categoria
            $table->foreign('id_trimestre')->references('id')->on('trimestre_tecnicos');
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
        Schema::dropIfExists('asignaturas_tecnicos');
    }
};
