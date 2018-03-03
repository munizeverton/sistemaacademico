<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('cursos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome');
            $table->float('valor_mensalidade');
            $table->float('valor_matricula');
            $table->integer('duracao')->comment('Duração do curso em meses');

            $table->integer('periodo_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();
        });

        \Schema::table('cursos', function ($table) {
            $table->foreign('periodo_id')->references('id')->on('periodos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Schema::dropIfExists('cursos');
    }
}
