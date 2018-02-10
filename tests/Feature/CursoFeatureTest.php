<?php

namespace Tests\Feature;

use App\Models\Curso;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\CursoBaseTest;

class CursoFeatureTest extends CursoBaseTest
{
    use DatabaseTransactions;

    public function testList()
    {
        $this->createFakeDataCurso(10);
        $response = $this->get('/cursos');

        $response->assertStatus(200);
        $page = new \DOMDocument();
        $page->loadHTML($response->getContent());
        /** @var \DOMElement[] $table */
        $table = $page->getElementsByTagName('table');
        $this->assertCount(11, $table[0]->getElementsByTagName('tr'));
    }

    public function testShow()
    {
        $curso = $this->getService()->store($this->getFakeCursoData());
        $response = $this->get('/cursos/' . $curso->id);

        $response->assertStatus(200);
        $response->assertSeeText($curso->nome);
        $response->assertSeeText($curso->valor_matricula_formatted);
        $response->assertSeeText($curso->valor_mensalidade_formatted);
        $response->assertSeeText($curso->periodo->nome);
        $response->assertSeeText((string)$curso->duracao);

        $response = $this->get('/cursos/' . 20);
        $response->assertSessionHas('flash-message');
        //$this->assertEquals('Curso não encontrado', session('flash-message'));
    }

    public function testShowCreateForm()
    {
        $response = $this->get(route('cursos.create'));

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $data = $this->getFakeCursoData();
        $data['_token'] = csrf_token();

        $response = $this->call('POST', 'cursos/', $data);

        $response->assertStatus(302);
        $response->assertRedirect('cursos/');
        $this->assertCount(1, Curso::all()->all());
    }

    public function testRequiredFields()
    {
        $data = $this->getFakeCursoData();
        unset($data['nome']);
        unset($data['valor_mensalidade']);
        unset($data['periodo_id']);
        unset($data['duracao']);
        $data['_token'] = csrf_token();

        $response = $this->call('POST', 'cursos/', $data);
        $errors = session('errors');

        $response->assertSessionHasErrors();
        $this->assertEquals($errors->get('nome')[0],'O campo Nome é obrigatório');
        $this->assertEquals($errors->get('valor_mensalidade')[0],'O campo Valor da Mensalidade é obrigatório');
        $this->assertEquals($errors->get('periodo_id')[0],'O campo Período é obrigatório');
        $this->assertEquals($errors->get('duracao')[0],'O campo Duração precisa ser um número');
    }

    public function testNumbersFields()
    {
        $data = $this->getFakeCursoData();
        $data['duracao'] = 'aaa';
        $data['_token'] = csrf_token();

        $response = $this->call('POST', 'cursos/', $data);
        $errors = session('errors');

        $response->assertSessionHasErrors();
        $this->assertEquals($errors->get('duracao')[0],'O campo Meses de Duração precisa ser um número');
    }

    public function testShowUpdateForm()
    {
        $curso = $this->getService()->store($this->getFakeCursoData());
        $response = $this->get(route('cursos.edit', ['aluno' => $curso->id]));

        $response->assertStatus(200);
    }

    public function testeUpdate()
    {
        $data = $this->getFakeCursoData();
        $curso = $this->getService()->store($data);
        $data['_token'] = csrf_token();
        $data['_method'] = 'PUT';
        $data['nome'] = 'Novo Curso';

        $response = $this->call('POST', 'cursos/' . $curso->id, $data);

        $novoCurso = Curso::find($curso->id);

        $response->assertStatus(302);
        $response->assertRedirect('cursos/');
        $this->assertInstanceOf(Curso::class, $novoCurso);
        $this->assertEquals('Novo Curso', $novoCurso->nome);
    }

    public function testDelete()
    {
        $data = $this->getFakeCursoData();
        $curso = $this->getService()->store($data);
        $data['_token'] = csrf_token();
        $data['_method'] = 'DELETE';

        $this->call('POST', 'cursos/' . $curso->id, $data);
        $this->assertCount(0, Curso::all()->all());


        $response = $this->call('POST', 'cursos/' . $curso->id, $data);
        $response->assertSessionHas('flash-message');
        $this->assertEquals('Curso não encontrado', session('flash-message'));
    }
}
