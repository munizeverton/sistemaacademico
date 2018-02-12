<?php

namespace Tests\Feature;

use App\Models\Matricula;
use App\Models\Pagamento;
use App\Models\TipoPagamento;
use App\Service\CalculoTroco;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\MatriculaBaseTest;
use Tests\TestCase;

class CalculoTrocoTest extends TestCase
{
    public function testValorExato()
    {
        $troco = CalculoTroco::calcula(100, 100);
        $this->assertEquals(['notas' => [], 'moedas' => []], $troco);

        $troco = CalculoTroco::calcula(100, 90);
        $this->assertEquals(['notas' => [], 'moedas' => []], $troco);
    }

    public function testUmaNota()
    {
        $troco = CalculoTroco::calcula(250, 350);
        $this->assertEquals(['notas' => [100 => 1], 'moedas' => []], $troco);

        $troco = CalculoTroco::calcula(50, 100);
        $this->assertEquals(['notas' => [50 => 1], 'moedas' => []], $troco);

        $troco = CalculoTroco::calcula(15, 20);
        $this->assertEquals(['notas' => [5 => 1], 'moedas' => []], $troco);
    }

    public function testDuasNotasIguais()
    {
        $troco = CalculoTroco::calcula(100, 300);
        $this->assertEquals(['notas' => [100 => 2], 'moedas' => []], $troco);

        $troco = CalculoTroco::calcula(80, 100);
        $this->assertEquals(['notas' => [10 => 2], 'moedas' => []], $troco);
    }

    public function testDuasNotasDiferentes()
    {
        $troco = CalculoTroco::calcula(40, 100);
        $this->assertEquals(['notas' => [50 => 1, 10 => 1], 'moedas' => []], $troco);

        $troco = CalculoTroco::calcula(85, 100);
        $this->assertEquals(['notas' => [10 => 1, 5 => 1], 'moedas' => []], $troco);
    }

    public function testTresNotas()
    {
        $troco = CalculoTroco::calcula(70, 100);
        $this->assertEquals(['notas' => [10 => 3], 'moedas' => []], $troco);

        $troco = CalculoTroco::calcula(30, 100);
        $this->assertEquals(['notas' => [50 => 1, 10 => 2], 'moedas' => []], $troco);

        $troco = CalculoTroco::calcula(35, 100);
        $this->assertEquals(['notas' => [50 => 1, 10 => 1, 5 => 1], 'moedas' => []], $troco);
    }

    public function testMoedas()
    {
        $troco = CalculoTroco::calcula(99.99, 100);
        $this->assertEquals(['notas' => [], 'moedas' => [1 => 1]], $troco);

        $troco = CalculoTroco::calcula(0.50, 1);
        $this->assertEquals(['notas' => [], 'moedas' => [50 => 1]], $troco);

        $troco = CalculoTroco::calcula(0.65, 1);
        $this->assertEquals(['notas' => [], 'moedas' => [10 => 3, 5 => 1]], $troco);
    }

    public function testNotasEMoedas()
    {
        $troco = CalculoTroco::calcula(22.40, 100);
        $this->assertEquals([
            'notas' => [
                50 => 1,
                10 => 2,
                5  => 1
            ],
            'moedas' => [
                1 => 2,
                50  => 1,
                10  => 1,
            ],
        ], $troco);
    }
}
