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
        Schema::create('ciclo_escolar', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_curso',100);
            $table->string('descripcion');
            //desactive $table->unsignedBigInteger('id_estado');//atributo para referenciar a categoria
            ////desactive $table->foreign('id_estado')->references('id')->on('estado');//llave foranea para referenciar a la tabla categorias
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
        Schema::dropIfExists('ciclo_escolar');
    }
};
