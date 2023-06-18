<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCliquesContatoAnunciantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliques_contato_anunciantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anunciante_id');
            $table->foreign('anunciante_id')->references('id')->on('anunciantes');
            $table->string('ip'); //IP do usuário que clicou no botão de contato
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
        Schema::dropIfExists('cliques_contato_anunciantes');
    }
}
