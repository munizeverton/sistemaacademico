<?php

namespace Tests\Feature;

use App\Models\Curso;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\CursoBaseTest;

use Faker\Factory as Faker;

class CursoServiceTest extends CursoBaseTest
{
    use DatabaseTransactions;

    public function testStoreCurso()
    {
        $service = $this->getService();

        $data = $this->getFakeCursoData();

        $service->store($data);
        $this->assertCount(1, Curso::all()->all());

        unset($data['nome']);

        $this->expectExceptionMessage('Ocorreu um erro ao gravar o curso');
        $service->store($data);
    }

    public function testShowCurso()
    {
        $faker = Faker::create();
        Curso::create([
            'id' => 1,
            'nome' => $faker->name,
            'valor_matricula' => $faker->randomFloat(),
            'valor_mensalidade' => $faker->randomFloat(),
            'duracao' => $faker->numberBetween(1, 12),
            'periodo_id' => 1,
        ]);
        $service = $this->getService();

        $curso = $service->show(1);

        $this->assertNotEmpty($curso);
        $this->assertInstanceOf(Curso::class, $curso);
        $this->assertNotEmpty($curso->nome);
        $this->assertNotEmpty($curso->valor_mensalidade);
        $this->assertNotEmpty($curso->valor_matricula);
        $this->assertNotEmpty($curso->duracao);
        $this->assertNotEmpty($curso->periodo_id);

        $this->expectExceptionMessage('Curso não encontrado');
        $service->show(10);
    }

    public function testListCurso()
    {
        $this->createFakeDataCurso(5);
        $cursos = $this->getService()->list();

        $this->assertCount(5, $cursos);
    }

    public function testUpdateCurso()
    {
        $faker = Faker::create();
        Curso::create([
            'id' => 1,
            'nome' => $faker->name,
            'valor_matricula' => $faker->randomFloat(),
            'valor_mensalidade' => $faker->randomFloat(),
            'duracao' => $faker->numberBetween(0, 12),
            'periodo_id' => 1,
        ]);
        $service = $this->getService();

        $data = $this->getFakeCursoData();

        $service->update(1, $data);
        $curso = Curso::find(1);

        $this->assertEquals('Curso Teste', $curso->nome);
        $this->assertEquals(200, $curso->valor_matricula);
        $this->assertEquals(195.9, $curso->valor_mensalidade);
        $this->assertEquals(12, $curso->duracao);
        $this->assertEquals(1, $curso->periodo_id);

        $this->expectExceptionMessage('Curso não encontrado');
        $service->update(2, $data);

        unset($data['cpf']);

        $this->expectExceptionMessage('Ocorreu um erro ao atualizar o curso');
        $service->update(1, $data);
    }

    public function testDeleteCurso()
    {
        $faker = Faker::create();
        Curso::create([
            'id' => 1,
            'nome' => $faker->name,
            'valor_matricula' => $faker->randomFloat(),
            'valor_mensalidade' => $faker->randomFloat(),
            'duracao' => $faker->numberBetween(0, 12),
            'periodo_id' => 1,
        ]);

        Curso::create([
            'id' => 2,
            'nome' => $faker->name,
            'valor_matricula' => $faker->randomFloat(),
            'valor_mensalidade' => $faker->randomFloat(),
            'duracao' => $faker->numberBetween(0, 12),
            'periodo_id' => 1,
        ]);

        $this->getService()->delete(2);

        $this->assertCount(1, Curso::all());

        $this->expectExceptionMessage('Curso não encontrado');
        $this->getService()->delete(2);
    }
}
