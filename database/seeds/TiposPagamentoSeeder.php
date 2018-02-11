<?php

use Illuminate\Database\Seeder;

class TiposPagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\TipoPagamento::create([
            'id' => 1,
            'nome' => 'Matrícula',
        ]);

        \App\Models\TipoPagamento::create([
            'id' => 2,
            'nome' => 'Mensalidade',
        ]);
    }
}
