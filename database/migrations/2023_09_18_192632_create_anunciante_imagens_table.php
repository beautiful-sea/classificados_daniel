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
        Schema::create('anunciante_imagens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anunciante_id');
            $table->string('path');
            $table->foreign('anunciante_id')->references('id')->on('anunciantes')->onDelete('cascade');
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
        Schema::dropIfExists('anunciante_imagens');
    }
};
