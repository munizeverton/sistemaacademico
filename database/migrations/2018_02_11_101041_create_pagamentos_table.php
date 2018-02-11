<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('pagamentos', function (Blueprint $table) {
            $table->increments('id');

            $table->dateTime('data');
            $table->float('valor');

            $table->dateTime('data_pagamento')->nullable();
            $table->float('valor_pago')->nullable();

            $table->integer('matricula_id')->unsigned();
            $table->integer('tipo_pagamento_id')->unsigned();

            $table->timestamps();
        });

        \Schema::table('pagamentos', function($table){
            $table->foreign('matricula_id')->references('id')->on('matriculas');
            $table->foreign('tipo_pagamento_id')->references('id')->on('tipos_pagamento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Schema::dropIfExists('pagamentos');
    }
}
