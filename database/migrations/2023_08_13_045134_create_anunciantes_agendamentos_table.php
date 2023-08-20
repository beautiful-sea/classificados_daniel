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
        Schema::create('anunciantes_agendamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anunciante_id');
            //Data do agendamento
            $table->date('data');
            //Horário do agendamento
            $table->time('horario');
            //Status do agendamento
            $table->enum('status', ['disponivel','agendado', 'cancelado', 'realizado'])->default('disponivel');
            //Relacionamento com a tabela de anunciantes
            $table->foreign('anunciante_id')->references('id')->on('anunciantes');
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
        Schema::dropIfExists('anunciantes_agendamentos');
    }
};
