<?php

namespace Tests\Feature;

use App\Models\Aluno;
use App\Service\AlunoService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlunoServiceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     * @throws \Exception
     */
    public function testStoreAluno()
    {
        $service = $this->getService();

        $data = [
            'nome' => 'Fulano',
            'cpf' => '44121672836',
            'rg' => '1234234',
            'data_nascimento' => '01/01/1990',
            'telefone' => '21 2362-2756'
        ];

        $service->store($data);

        $this->assertCount(1, Aluno::all()->all());
    }

    /**
     * @return AlunoService
     */
    private function getService()
    {
        return new AlunoService();
    }
}
