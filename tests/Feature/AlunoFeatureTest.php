<?php

namespace Tests\Feature;

use App\Models\Aluno;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\AlunoBaseTest;

class AlunoFeatureTest extends AlunoBaseTest
{
    use DatabaseTransactions;

    public function testList()
    {
        $this->createFakeDataAluno(10);
        $response = $this->get('/alunos');

        $response->assertStatus(200);
        $page = new \DOMDocument();
        $page->loadHTML($response->getContent());
        /** @var \DOMElement[] $table */
        $table = $page->getElementsByTagName('table');
        $this->assertCount(11, $table[0]->getElementsByTagName('tr'));
    }

    public function testShow()
    {
        $aluno = $this->getService()->store($this->getFakeAlunoData());
        $response = $this->get('/alunos/' . $aluno->id);

        $response->assertStatus(200);
        $response->assertSeeText($aluno->nome);
        $response->assertSeeText($aluno->data_nascimento);
        $response->assertSeeText($aluno->telefone);
        $response->assertSeeText($aluno->cpf);
        $response->assertSeeText($aluno->rg);

        $response = $this->get('/alunos/' . 20);
        $response->assertSessionHas('flash-message');
    }

    public function testShowCreateForm()
    {
        $response = $this->get(route('alunos.create'));

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $data = $this->getFakeAlunoData();
        $data['_token'] = csrf_token();

        $response = $this->call('POST', 'alunos/', $data);

        $response->assertStatus(302);
        $response->assertRedirect('alunos/');
        $this->assertCount(1, Aluno::all()->all());
    }

    public function testRequiredFields()
    {
        $data = $this->getFakeAlunoData();
        unset($data['cpf']);
        unset($data['nome']);
        $data['_token'] = csrf_token();

        $response = $this->call('POST', 'alunos/', $data);
        $errors = session('errors');
        $response->assertSessionHasErrors();
        $this->assertEquals($errors->get('nome')[0],'O campo Nome é obrigatório');
        $this->assertEquals($errors->get('cpf')[0],'O campo CPF é obrigatório');
    }

    public function testValidacaoCpf()
    {
        $data = $this->getFakeAlunoData();
        $data['cpf'] = '2123324234';
        $data['_token'] = csrf_token();

        $response = $this->call('POST', 'alunos/', $data);
        $errors = session('errors');
        $response->assertSessionHasErrors();
        $this->assertEquals($errors->get('cpf')[0],'O CPF deve ser valido');
    }

    public function testeDuplicateCpf()
    {
        $data = $this->getFakeAlunoData();
        $data['_token'] = csrf_token();

        $this->call('POST', 'alunos/', $data);
        $response = $this->call('POST', 'alunos/', $data);
        $errors = session('errors');
        $response->assertSessionHasErrors();
        $this->assertEquals($errors->get('cpf')[0],'O CPF informado já está cadastrado');
    }

    public function testShowUpdateForm()
    {
        $aluno = $this->getService()->store($this->getFakeAlunoData());
        $response = $this->get(route('alunos.edit', ['aluno' => $aluno->id]));

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $data = $this->getFakeAlunoData();
        $aluno = $this->getService()->store($data);
        $data['_token'] = csrf_token();
        $data['_method'] = 'PUT';
        $data['nome'] = 'Novo Nome';

        $response = $this->call('POST', 'alunos/' . $aluno->id, $data);

        $novoAluno = Aluno::find($aluno->id);

        $response->assertStatus(302);
        $response->assertRedirect('alunos/');
        $this->assertInstanceOf(Aluno::class, $novoAluno);
        $this->assertEquals('Novo Nome', $novoAluno->nome);
    }

    public function testDelete()
    {
        $data = $this->getFakeAlunoData();
        $aluno = $this->getService()->store($data);
        $data['_token'] = csrf_token();
        $data['_method'] = 'DELETE';

        $this->call('POST', 'alunos/' . $aluno->id, $data);
        $this->assertCount(0, Aluno::all()->all());


        $response = $this->call('POST', 'alunos/' . $aluno->id, $data);
        $response->assertSessionHas('flash-message');
        $this->assertEquals('Aluno não encontrado', session('flash-message'));
    }
}
