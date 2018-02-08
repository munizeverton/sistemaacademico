<?php
/**
 * Created by PhpStorm.
 * User: evertonmuniz
 * Date: 07/02/18
 * Time: 22:44
 */

namespace App\Service;


use App\Models\Aluno;

class AlunoService
{

    public function store(array $data): Aluno
    {
        $aluno = new Aluno();

        $aluno->cpf = $data['cpf'];
        $aluno->nome = $data['nome'];
        $aluno->rg = $data['rg'];
        $aluno->data_nascimento = $data['data_nascimento'];
        $aluno->telefone = $data['telefone'];

        $aluno->save();

        return $aluno;
    }

}