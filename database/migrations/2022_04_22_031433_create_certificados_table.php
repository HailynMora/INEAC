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
        Schema::create('certificados', function (Blueprint $table) {
            $table->id();
            $table->string('cert_medico')->nullable();
            $table->string('cert_estudios')->nullable();
            $table->string('foto')->nullable();
            $table->string('recibo_energia')->nullable();
            $table->string('copia_doc_estudiante')->nullable();
            $table->string('copia_doc_acudiente')->nullable();
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
        Schema::dropIfExists('certificados');
    }
};
