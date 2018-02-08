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
        \App\Models\Periodo::create(['nome' => 'Matutino']);
        \App\Models\Periodo::create(['nome' => 'Vespertino']);
        \App\Models\Periodo::create(['nome' => 'Noturno']);
    }
}
