<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitasPaginaAnunciantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas_pagina_anunciantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anunciante_id');
            $table->foreign('anunciante_id')->references('id')->on('anunciantes')->onDelete('cascade');
            $table->string('ip');
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
        Schema::dropIfExists('visitas_pagina_anunciantes');
    }
}
