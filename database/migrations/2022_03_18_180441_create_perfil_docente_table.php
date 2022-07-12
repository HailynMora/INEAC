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
        Schema::create('perfil_docente', function (Blueprint $table) {
            $table->id();
            $table->string('nivel_estudios');
            $table->string('intereses');
            $table->string('descripcion');
            $table->string('cursos_realizados');
            $table->string('Experiencia');
            $table->string('imagen')->nullable();
            $table->unsignedBigInteger('id_usuario');//atributo para referenciar a categoria
            $table->foreign('id_usuario')->references('id')->on('users');//llave foranea para referenciar a la tabla categorias
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
        Schema::dropIfExists('perfil_docente');
    }
};
