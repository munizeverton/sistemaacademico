<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Curso::class, function (Faker $faker) {
    return [
        'nome' =>  $faker->name,
        'valor_matricula' => $faker->randomFloat(),
        'valor_mensalidade' => $faker->randomFloat(),
        'duracao' => $faker->numberBetween(0,12),
        'periodo_id' => 1,
    ];
});
