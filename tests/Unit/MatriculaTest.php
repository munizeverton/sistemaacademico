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
        $seeder = new class() extends Seeder {
            public function run()
            {
                $this->call(\MatriculaTestSeeder::class);
            }
        };
        $seeder->run();

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
        $seeder = new class() extends Seeder {
            public function run()
            {
                $this->call(\MatriculaTestSeeder::class);
            }
        };
        $seeder->run();

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
}
