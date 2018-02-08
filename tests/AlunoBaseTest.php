<?php

namespace Tests;

use App\Models\Aluno;
use App\Service\AlunoService;

abstract class AlunoBaseTest extends TestCase
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
}
