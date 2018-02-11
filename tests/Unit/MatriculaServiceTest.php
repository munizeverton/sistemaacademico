<?php

namespace Tests\Feature;

use App\Models\Matricula;
use App\Models\Pagamento;
use App\Service\MatriculaService;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\CursoBaseTest;

use Faker\Factory as Faker;

class MatriculaServiceTest extends CursoBaseTest
{
    use DatabaseTransactions;

    public function testStoreMatricula()
    {
        $service = $this->getService();
        $seeder = new class() extends Seeder {
            public function run()
            {
                $this->call(\MatriculaTestSeeder::class);
            }
        };
        $seeder->run();

        $service->store(1, 1, 2018);
        $this->assertCount(1, Matricula::all()->all());
        $this->assertEquals('Fulano', Matricula::all()->first()->aluno->nome);
        $this->assertEquals('Curso Teste', Matricula::all()->first()->curso->nome);
        $this->assertEquals('2018', Matricula::all()->first()->ano);

        $this->expectExceptionMessage('Aluno não encontrado');
        $service->store(2, 1, 2018);

        $this->expectExceptionMessage('Curso não encontrado');
        $service->store(1, 2, 2018);
    }

    public function testStorePagamentosMatricula()
    {
        $service = $this->getService();
        $seeder = new class() extends Seeder {
            public function run()
            {
                $this->call(\MatriculaTestSeeder::class);
            }
        };
        $seeder->run();

        $service->store(1, 1, 2018);

        $this->assertCount(13, Pagamento::class);
    }

    /**
     * @return \App\Service\MatriculaService
     */
    public function getService()
    {
        return new MatriculaService();
    }
}
