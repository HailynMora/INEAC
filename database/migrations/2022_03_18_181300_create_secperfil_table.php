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
        Schema::create('secperfil', function (Blueprint $table) {
            $table->id();
            $table->string('nivel_estudios');
            $table->string('descripcion');
            $table->unsignedBigInteger('id_secretaria');//atributo para referenciar a categoria
            $table->foreign('id_secretaria')->references('id')->on('secretaria');//llave foranea para referenciar a la tabla categorias
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
        Schema::dropIfExists('secperfil');
    }
};
