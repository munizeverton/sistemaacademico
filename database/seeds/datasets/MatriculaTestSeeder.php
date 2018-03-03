<?php

use App\Models\Aluno;
use App\Models\Curso;
use Illuminate\Database\Seeder;

class MatriculaTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Aluno::create([
            'id' => 1,
            'nome' => 'Fulano',
            'cpf' => '44121672836',
            'rg' => '1234234',
            'data_nascimento' => '01/01/1990',
            'telefone' => '21 2362-2756',
        ]);

        Curso::create([
            'id' => 1,
            'nome' => 'Curso Teste',
            'valor_matricula' => 200,
            'valor_mensalidade' => 195.90,
            'duracao' => 12,
            'periodo_id' => 1,
        ]);
    }
}
