<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\AlunoBaseTest;

class AlunoFeatureTest extends AlunoBaseTest
{
    use DatabaseTransactions;

    public function testListAlunos()
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
}
