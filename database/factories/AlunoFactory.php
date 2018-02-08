<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Aluno::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'cpf' => $faker->text(11),
        'rg' => $faker->text(6),
        'data_nascimento' => $faker->dateTimeThisCentury,
        'telefone' => $faker->phoneNumber,
    ];
});
