<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnunciantesTable extends Migration
{
    public function up()
    {
        Schema::create('anunciantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->unsignedBigInteger('subcategoria_id');
            $table->string('nome');
            $table->text('descricao');
            $table->string('telefone');
            $table->string('email');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('subcategoria_id')->references('id')->on('categorias');
        });
    }

    public function down()
    {
        Schema::dropIfExists('anunciantes');
    }
}
