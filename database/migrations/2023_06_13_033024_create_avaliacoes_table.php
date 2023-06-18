<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvaliacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->id();
            //Email, nome e whatsapp do avaliador
            $table->string('email');
            $table->string('nome');
            $table->string('whatsapp');
            $table->foreignId('anunciante_id')->constrained('anunciantes');
            $table->text('comentario')->nullable();
            $table->timestamps();
        });
        Schema::create('campo_avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamps();
        });
        Schema::create('avaliacao_campo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('avaliacao_id')->constrained('avaliacoes');
            $table->foreignId('campo_avaliacao_id')->constrained('campo_avaliacoes');
            $table->integer('nota')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {

        Schema::dropIfExists('avaliacao_campo');
        Schema::dropIfExists('avaliacoes');
        Schema::dropIfExists('campo_avaliacoes');
    }
}
