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
        Schema::create('asig_tecnicos', function (Blueprint $table) {
            $table->id();
            $table->string('nombreasig',200)->unique();
            $table->string('codigoasig',200)->unique();
            $table->Integer('intensidad_horaria');
            $table->Integer('val_habilitacion')->nullable();
            $table->unsignedBigInteger('id_estado');//atributo para referenciar a categoria
            $table->foreign('id_estado')->references('id')->on('estado');//llave foranea para referenciar a la tabla estado
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
        Schema::dropIfExists('asig_tecnicos');
    }
};
