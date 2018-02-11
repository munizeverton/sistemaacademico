<?php

namespace Tests\Feature;

use App\Models\Matricula;
use App\Models\Pagamento;
use App\Models\TipoPagamento;
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

        $pagamento = Pagamento::whereMatriculaId($matricula->id)->where('tipo_pagamento_id', TipoPagamento::MATRICULA)->first();
        $pagamento->valor_pago = $pagamento->valor;
        $pagamento->data_pagamento = (new \DateTime());
        $pagamento->save();

        $this->assertTrue($matricula->isPagamentoPendente());
    }

    public function testMatriculaSemPagamentoPendente()
    {
        $this->runSeeder();
        $matricula = $this->getService()->store(1,1,date('Y'));

        $pagamentos = Pagamento::whereMatriculaId($matricula->id)->get();
        foreach($pagamentos as $pagamento) {
            $pagamento->valor_pago = $pagamento->valor;
            $pagamento->data_pagamento = (new \DateTime());
            $pagamento->save();
        }

        $this->assertFalse($matricula->isPagamentoPendente());
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
