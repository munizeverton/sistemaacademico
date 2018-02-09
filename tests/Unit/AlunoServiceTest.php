<?php

namespace Tests\Feature;

use App\Models\Aluno;
use App\Service\AlunoService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\AlunoBaseTest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Faker\Factory as Faker;

class AlunoServiceTest extends AlunoBaseTest
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

        $data = $this->getFakeAlunoData();

        $service->store($data);
        $this->assertCount(1, Aluno::all()->all());

        unset($data['cpf']);

        $this->expectExceptionMessage('Ocorreu um erro ao gravar o aluno');
        $service->store($data);
    }

    public function testShowAluno()
    {
        $faker = Faker::create();
        Aluno::create([
            'id' => 1,
            'nome' => $faker->name,
            'cpf' => $faker->text(11),
        ]);
        $service = $this->getService();

        $aluno = $service->show(1);

        $this->assertNotEmpty($aluno);
        $this->assertInstanceOf(Aluno::class, $aluno);
        $this->assertNotEmpty($aluno->nome);
        $this->assertNotEmpty($aluno->cpf);

        $this->expectExceptionMessage('Aluno não encontrado');
        $service->show(10);
    }

    public function testListAluno()
    {
        $this->createFakeDataAluno(5);
        $alunos = $this->getService()->list();

        $this->assertCount(5, $alunos);
    }

    public function testUpdateAluno()
    {
        $faker = Faker::create();
        Aluno::create([
            'id' => 1,
            'nome' => $faker->name,
            'cpf' => $faker->text(11),
        ]);
        $service = $this->getService();

        $data = $this->getFakeAlunoData();

        $service->update(1, $data);
        $aluno = Aluno::find(1);

        $this->assertEquals('Fulano', $aluno->nome);
        $this->assertEquals('44121672836', $aluno->cpf);
        $this->assertEquals('1234234', $aluno->rg);
        $this->assertEquals('01/01/1990', $aluno->data_nascimento);
        $this->assertEquals('21 2362-2756', $aluno->telefone);

        $this->expectExceptionMessage('Aluno não encontrado');
        $service->update(2, $data);

        unset($data['cpf']);

        $this->expectExceptionMessage('Ocorreu um erro ao atualizar o aluno');
        $service->update(1, $data);
    }

    public function testDeleteAluno()
    {
        $faker = Faker::create();
        Aluno::create([
            'id' => 1,
            'nome' => $faker->name,
            'cpf' => $faker->text(11),
        ]);

        Aluno::create([
            'id' => 2,
            'nome' => $faker->name,
            'cpf' => $faker->text(11),
        ]);

        $this->getService()->delete(2);

        $this->assertCount(1, Aluno::all());

        $this->expectExceptionMessage('Aluno não encontrado');
        $this->getService()->delete(2);
    }
}
