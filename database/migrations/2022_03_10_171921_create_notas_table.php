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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->string('nota1',200);
            $table->string('por1',200);
            $table->string('nota2',200);
            $table->string('por2',200);
            $table->string('nota3',200);
            $table->string('por3',200);
            $table->string('nota4',200);
            $table->string('por4',200);
            $table->string('definitiva',200);
            $table->unsignedBigInteger('id_curso');//atributo para referenciar a categoria
            $table->foreign('id_curso')->references('id')->on('cursos');//llave foranea para referenciar a la tabla categorias
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
        Schema::dropIfExists('notas');
    }
};
