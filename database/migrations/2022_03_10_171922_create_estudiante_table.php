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
            $table->string('first_nom',100);
            $table->string('second_nom',50)->nullable();
            $table->string('firts_ape',50);
            $table->string('second_ape',50)->nullable();
            $table->string('tiposangre',50)->nullable();
            $table->string('dirresidencia',100)->nullable();
            $table->string('dptresidencia',100)->nullable();
            $table->string('munresidencia',100)->nullable();
            $table->string('zona',100)->nullable();
            $table->string('barrio',100)->nullable();
            $table->string('telefono')->nullable();
            $table->string('num_doc')->unique();
            $table->string('dpt_expedicion')->nullable();
            $table->string('mun_expedicion')->nullable();
            $table->dateTime('fecnacimiento');
            $table->string('dpt_nacimiento')->nullable();
            $table->string('mun_nacimiento')->nullable();
            $table->string('correo',100)->unique();
            $table->string('estrato',100);
            $table->unsignedBigInteger('id_genero');//atributo para referenciar a categoria
            $table->foreign('id_genero')->references('id')->on('genero');//llave foranea para referenciar a la tabla categorias
            $table->unsignedBigInteger('id_tipo_doc');//atributo para referenciar a categoria
            $table->foreign('id_tipo_doc')->references('id')->on('tipo_documento');//llave foranea para referenciar a la tabla categorias
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
