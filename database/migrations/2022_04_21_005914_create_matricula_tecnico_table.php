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
        Schema::create('matricula_tecnico', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_estudiante');//atributo para referenciar a categoria
            $table->foreign('id_estudiante')->references('id')->on('estudiante');//llave foranea para referenciar a la tabla categorias
            $table->unsignedBigInteger('id_tecnico');//atributo para referenciar a categoria
            $table->foreign('id_tecnico')->references('id')->on('programa_tecnico');//llave foranea para referenciar a la tabla categorias
            $table->unsignedBigInteger('id_aprobado');//atributo para referenciar a categoria
            $table->foreign('id_aprobado')->references('id')->on('aprobado');
            $table->unsignedBigInteger('id_trimestre');//atributo para referenciar a categoria
            $table->foreign('id_trimestre')->references('id')->on('trimestre_tecnicos');
            $table->string('anio');
            $table->string('periodo');
            $table->dateTime('fec_matricula');
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
        Schema::dropIfExists('matricula_tecnico');
    }
};
