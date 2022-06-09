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
        Schema::create('objetivostec', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',100);
            $table->unsignedBigInteger('id_asignaturas');//atributo para referenciar a categoria
            $table->foreign('id_asignaturas')->references('id')->on('asignaturas_tecnicos');
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
        Schema::dropIfExists('objetivostec');
    }
};
