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
        Schema::create('programa_tecnico', function (Blueprint $table) {
            $table->id();
            $table->string('codigotec');
            $table->string('nombretec');
            $table->unsignedBigInteger('id_estado');
            $table->foreign('id_estado')->references('id')->on('estado');
            $table->unsignedBigInteger('id_trimestre');//atributo para referenciar a categoria
            $table->foreign('id_trimestre')->references('id')->on('trimestre_tecnicos');
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
        Schema::dropIfExists('programa_tecnico');
    }
};
