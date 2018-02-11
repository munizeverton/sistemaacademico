<?php

namespace Tests\Feature;

use App\Models\Matricula;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\MatriculaBaseTest;

class MatriculaTest extends MatriculaBaseTest
{
    use DatabaseTransactions;

    public function testCheckMatriculaIsAtiva()
    {
        $this->runSeeder();
        $matricula = Matricula::create([
            'id' => 1,
            'aluno_id' => 1,
            'curso_id' => 1,
            'ano' => date('y'),
            'data_cancelamento' => null
        ]);

        $this->assertTrue($matricula->isAtiva());
    }

    public function testCheckMatriculaIsInativa()
    {
        $this->runSeeder();
        $this->getService();
        $matricula = Matricula::create([
            'aluno_id' => 1,
            'curso_id' => 1,
            'ano' => date('Y'),
            'data_cancelamento' => (new \DateTime()),
        ]);
        $this->assertFalse($matricula->isAtiva());

        $matricula = Matricula::create([
            'aluno_id' => 1,
            'curso_id' => 1,
            'ano' => date('Y') - 2,
            'data_cancelamento' => null
        ]);
        $this->assertFalse($matricula->isAtiva());

        $matricula = Matricula::create([
            'aluno_id' => 1,
            'curso_id' => 1,
            'ano' => date('Y') + 2,
            'data_cancelamento' => null
        ]);
        $this->assertFalse($matricula->isAtiva());
    }

    public function testMatriculaPagamentoPendente()
    {
        $this->runSeeder();
        $matricula = $this->getService()->store(1,1,date('Y'));
        $this->assertTrue($matricula->isPagamentoPendente());
    }

    private function runSeeder()
    {
        $seeder = new class() extends Seeder
        {
            public function run()
            {
                $this->call(\MatriculaTestSeeder::class);
            }
        };
        $seeder->run();
    }
}
