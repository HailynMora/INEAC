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
        Schema::create('asignaturas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',200);
            $table->string('codigo',200);
            $table->Integer('intensidad_horaria');
            $table->Integer('val_habilitacion');
            $table->unsignedBigInteger('id_objetivos');//atributo para referenciar a categoria
            $table->foreign('id_objetivos')->references('id')->on('objetivos');//llave foranea para referenciar a la tabla categorias
            $table->unsignedBigInteger('id_desempenos');//atributo para referenciar a categoria
            $table->foreign('id_desempenos')->references('id')->on('desempenos');//llave foranea para referenciar a la tabla categorias
            $table->unsignedBigInteger('id_estado');//atributo para referenciar a categoria
            $table->foreign('id_estado')->references('id')->on('estado');//llave foranea para referenciar a la tabla categorias
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
        Schema::dropIfExists('asignaturas');
    }
};
