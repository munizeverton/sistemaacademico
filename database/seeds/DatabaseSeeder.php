<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PeriodosSeeder::class);
        $this->call(TiposPagamentoSeeder::class);
    }
}
