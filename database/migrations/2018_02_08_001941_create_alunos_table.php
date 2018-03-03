<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('alunos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('cpf')->unique();
            $table->string('rg')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('nome');
            $table->string('telefone')->nullable();

            $table->softDeletes();
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
        \Schema::dropIfExists('alunos');
    }
}
