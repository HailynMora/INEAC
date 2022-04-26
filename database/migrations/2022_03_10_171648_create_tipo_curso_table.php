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
        Schema::create('tipo_curso', function (Blueprint $table) {
            //aqui son los programas ofertados
            $table->id();
            $table->string('codigo',10);
            $table->string('descripcion',100);
            $table->string('cursodes');
            $table->string('jornada');
            $table->unsignedBigInteger('id_estado');//atributo para referenciar a categoria
            $table->foreign('id_estado')->references('id')->on('estado');//llave foranea para referenciar a la tabla categorias
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
        Schema::dropIfExists('tipo_curso');
    }
};
