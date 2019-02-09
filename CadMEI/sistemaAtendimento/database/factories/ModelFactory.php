<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'nivel' => $faker->nivel,
    ];
});


//Empresario
$factory->define(App\Empresario::class, function (Faker $faker) {
    return [
        'nome' => $faker->nome,
        'rg' => $faker->rg,
        'cpf' => $faker->cpf,
        'titulo_eleitor' => $faker->titulo_eleitor,
        'sexo' => $faker->sexo,
        'nascimento' => $faker->nascimento,
        'email' => $faker->email,
        'celular' => $faker->celular,
        'numero' => $faker->numero,
        'endereco' => $faker->endereco,
        'bairro' => $faker->bairro,
        'cidade' => $faker->cidade,
        'estado' => $faker->estado,
        'cep' => $faker->cep,
    ];
});

//Empresa
$factory->define(App\Empresa::class, function (Faker $faker) {
    return [
        'nome' => $faker->nome,
        'cnpj' => $faker->cnpj,
        'empresario_id' => $faker->empresario_id,
        'abertura' => $faker->abertura,
        'setor_id' => $faker->setor_id,
        'cnae' => $faker->cnae,
        'senha_nfse' => $faker->senha_nfse, 
        'senha_simples_nacional' => $faker->senha_simples_nacional,
        'numero' => $faker->numero,
        'endereco' => $faker->endereco,
        'bairro' => $faker->bairro,
        'cidade' => $faker->cidade,
        'estado' => $faker->estado,
        'cep' => $faker->cep,
    ];
});

//Serviço
$factory->define(App\Servico::class, function (Faker $faker) {
    return [
        'descricao' => $faker->descricao,
    ];
});

//Setor
$factory->define(App\Setor::class, function (Faker $faker) {
    return [
        'descricao' => $faker->descricao,
    ];
});