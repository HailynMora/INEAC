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
        Schema::create('notas_tecnico', function (Blueprint $table) {
            $table->id();
            $table->string('nota1',20);
            $table->string('por1',20);
            $table->string('nota2',20);
            $table->string('por2',20);
            $table->string('nota3',20);
            $table->string('por3',20);
            $table->string('nota4',20);
            $table->string('por4',20);
            $table->string('definitiva',20);
            $table->unsignedBigInteger('id_tecnicos');//atributo para referenciar a categoria
            $table->foreign('id_tecnicos')->references('id')->on('asignaturas_tecnicos');//llave foranea para referenciar a la tabla categorias
            $table->unsignedBigInteger('id_estudiante');//atributo para referenciar a categoria
            $table->foreign('id_estudiante')->references('id')->on('estudiante');//llave foranea para referenciar a la tabla categorias
            $table->unsignedBigInteger('id_desempenio');//atributo para referenciar a categoria
            $table->foreign('id_desempenio')->references('id')->on('desempenos');
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
        Schema::dropIfExists('notas_tecnico');
    }
};
