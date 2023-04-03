<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasTable extends Migration
{
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedBigInteger('categoria_pai_id')->nullable();
            $table->timestamps();

            $table->foreign('categoria_pai_id')->references('id')->on('categorias');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}
