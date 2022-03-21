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
        Schema::create('acudiente', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->string('apellido',100);
            $table->string('direccion',100);
            $table->string('telefono');
            $table->string('num_doc');
            $table->unsignedBigInteger('id_parentesco');//atributo para referenciar a categoria
            $table->foreign('id_parentesco')->references('id')->on('parentezco');//llave foranea para referenciar a la tabla categorias
            $table->unsignedBigInteger('id_tipo_doc');//atributo para referenciar a categoria
            $table->foreign('id_tipo_doc')->references('id')->on('tipo_documento');//llave foranea para referenciar a la tabla categorias
            $table->unsignedBigInteger('id_genero');//atributo para referenciar a categoria
            $table->foreign('id_genero')->references('id')->on('genero');//llave foranea para referenciar a la tabla categorias
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
        Schema::dropIfExists('acudiente');
    }
};
