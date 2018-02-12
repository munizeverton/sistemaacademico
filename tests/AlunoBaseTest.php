<?php

namespace Tests;

use App\Models\Aluno;
use App\Service\AlunoService;

abstract class AlunoBaseTest extends DatabaseTestCase
{
    /**
     * @return AlunoService
     */
    protected function getService()
    {
        return new AlunoService();
    }

    protected function createFakeDataAluno($quantity = 1)
    {
        factory(Aluno::class, $quantity)->create()->each(function ($model) {
            $model->save(factory(Aluno::class)->make()->getAttributes());
        });
    }

    protected function getFakeAlunoData()
    {
        return [
            'nome' => 'Fulano',
            'cpf' => '44121672836',
            'rg' => '1234234',
            'data_nascimento' => '01/01/1990',
            'telefone' => '21 2362-2756'
        ];
    }
}
