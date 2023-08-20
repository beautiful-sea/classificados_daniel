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
        //Deleta a tabela agendamentos
        Schema::create('agendamentos', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('anunciante_id');
            $table->unsignedBigInteger('anunciantes_agendamento_id');
            $table->foreign('anunciante_id')->references('id')->on('anunciantes');
            $table->foreign('anunciantes_agendamento_id')->references('id')->on('anunciantes_agendamentos');
            //Nome do cliente
            $table->string('nome');
            //Telefone do cliente
            $table->string('telefone');
            //Visitante_id
            $table->unsignedBigInteger('visitante_id')->nullable();
            $table->foreign('visitante_id')->references('id')->on('visitantes');
            //Data e hora do agendamento
            $table->dateTime('data');
            //Status do agendamento
            $table->enum('status',['disponivel','agendado', 'cancelado', 'realizado'])->default('disponivel');
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
        Schema::dropIfExists('agendamentos');
    }
};
