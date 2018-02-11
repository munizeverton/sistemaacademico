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
            'nome' => 'Matrícula',
        ]);

        \App\Models\TipoPagamento::create([
            'nome' => 'Mensalidade',
        ]);
    }
}
