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
        Schema::create('sistema_salud', function (Blueprint $table) {
            $table->id();
            $table->string('regimen',100);
            $table->string('eps',100);
            $table->string('nivelformacion',100)->nullable();
            $table->string('ocupacion',100)->nullable();
            $table->string('discapacidad',100)->nullable();
            $table->unsignedBigInteger('id_etnia');//atributo para referenciar a categoria
            $table->foreign('id_etnia')->references('id')->on('etnia');//llave foranea para referenciar a la tabla categorias
            $table->unsignedBigInteger('id_estudiante');//atributo para referenciar a categoria
            $table->foreign('id_estudiante')->references('id')->on('estudiante');//llave foranea para referenciar a la tabla categorias
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
        Schema::dropIfExists('sistema_salud');
    }
};
