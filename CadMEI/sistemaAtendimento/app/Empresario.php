<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresario extends Model
{
    protected $table = 'empresarios';

    protected $fillable = [
        'nome', 'rg', 'cpf', 'titulo_eleitor', 'nascimento', 'sexo', 'email',
        'celular', 'numero', 'endereco', 'complemento', 'bairro', 'cidade', 'estado', 'cep'
    ];
}