<?php

use Illuminate\Database\Seeder;

class PeriodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Periodo::create(['id' => 1, 'nome' => 'Matutino']);
        \App\Models\Periodo::create(['id' => 2, 'nome' => 'Vespertino']);
        \App\Models\Periodo::create(['id' => 3, 'nome' => 'Noturno']);
    }
}
