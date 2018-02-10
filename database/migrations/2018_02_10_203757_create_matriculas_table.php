<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatriculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('matriculas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('curso_id')->unsigned();
            $table->integer('aluno_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();
        });

        \Schema::table('matriculas', function($table){
            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->foreign('aluno_id')->references('id')->on('alunos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Schema::dropIfExists('matriculas');
    }
}
