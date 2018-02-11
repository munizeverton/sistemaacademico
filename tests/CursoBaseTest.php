<?php

namespace Tests;

use App\Models\Curso;
use App\Service\CursoService;

abstract class CursoBaseTest extends TestCase
{
    /**
     * @return CursoService
     */
    protected function getService()
    {
        return new CursoService();
    }

    protected function createFakeDataCurso($quantity = 1)
    {
        factory(Curso::class, $quantity)->create()->each(function ($model) {
            $model->save(factory(Curso::class)->make()->getAttributes());
        });
    }

    protected function getFakeCursoData()
    {
        return [
            'nome' => 'Curso Teste',
            'valor_matricula' => 200,
            'valor_mensalidade' => 195.90,
            'duracao' => 12,
            'periodo_id' => 1
        ];
    }

    public function setUp()
    {
        parent::setUp();
        \Artisan::call('migrate');
        \Artisan::call('db:seed', ['--env' => 'testing']);
    }


    public function tearDown()
    {
        \Artisan::call('migrate:reset');
        parent::tearDown();
    }
}