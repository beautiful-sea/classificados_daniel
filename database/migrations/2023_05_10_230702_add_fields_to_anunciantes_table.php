<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToAnunciantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anunciantes', function (Blueprint $table) {
            //Valor hora
            $table->decimal('valor_hora', 10, 2)->nullable();
            //Foto Principal
            $table->string('foto_principal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anunciantes', function (Blueprint $table) {
            $table->dropColumn('valor_hora');
            $table->dropColumn('foto_principal');
        });
    }
}
