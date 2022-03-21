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
        Schema::create('estudiante', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->string('apellido',100);
            $table->string('direccion',100);
            $table->string('telefono')->nullable();
            $table->Integer('num_doc')->unique();
            $table->string('correo',100)->unique();
            $table->string('estrato',100);
            $table->unsignedBigInteger('id_etnia');//atributo para referenciar a categoria
            $table->foreign('id_etnia')->references('id')->on('etnia');//llave foranea para referenciar a la tabla categorias
            $table->unsignedBigInteger('id_genero');//atributo para referenciar a categoria
            $table->foreign('id_genero')->references('id')->on('genero');//llave foranea para referenciar a la tabla categorias
            $table->unsignedBigInteger('id_acudiente');//atributo para referenciar a categoria
            $table->foreign('id_acudiente')->references('id')->on('acudiente');//llave foranea para referenciar a la tabla categorias
            $table->unsignedBigInteger('id_tipo_doc');//atributo para referenciar a categoria
            $table->foreign('id_tipo_doc')->references('id')->on('tipo_documento');//llave foranea para referenciar a la tabla categorias
            $table->unsignedBigInteger('id_certificados');//atributo para referenciar a categoria
            $table->foreign('id_certificados')->references('id')->on('certificados');//llave foranea para referenciar a la tabla categorias
            $table->unsignedBigInteger('id_estado');//atributo para referenciar a categoria
            $table->foreign('id_estado')->references('id')->on('estado');//llave foranea para referenciar a la tabla categorias
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
        Schema::dropIfExists('estudiante');
    }
};
