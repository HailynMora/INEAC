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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',200);
            $table->unsignedBigInteger('id_asignatura');//atributo para referenciar a categoria
            $table->foreign('id_asignatura')->references('id')->on('asignaturas');//llave foranea para referenciar a la tabla categorias
            $table->unsignedBigInteger('id_tipo_curso');//atributo para referenciar a categoria
            $table->foreign('id_tipo_curso')->references('id')->on('tipo_curso');//llave foranea para referenciar a la tabla categorias
            $table->unsignedBigInteger('id_fecha');//atributo para referenciar a categoria
            $table->foreign('id_fecha')->references('id')->on('fecha');//llave foranea para referenciar a la tabla categorias
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
        Schema::dropIfExists('cursos');
    }
};
