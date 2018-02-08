<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Aluno::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'cpf' => $faker->password(11,11),
        'rg' => $faker->text(6),
        'data_nascimento' => $faker->dateTimeThisCentury,
        'telefone' => $faker->phoneNumber,
    ];
});
