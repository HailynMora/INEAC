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
        Schema::create('docente', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->string('apellido',100);
            $table->string('direccion',100);
            $table->Integer('telefono')->nullable();
            $table->string('correo',100)->unique();
            $table->Integer('num_doc')->unique();
            $table->dateTime('fec_vinculacion');
            $table->unsignedBigInteger('id_usuario');//atributo para referenciar a categoria
            $table->foreign('id_usuario')->references('id')->on('users');//llave foranea para referenciar a la tabla categorias
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
        Schema::dropIfExists('docente');
    }
};
