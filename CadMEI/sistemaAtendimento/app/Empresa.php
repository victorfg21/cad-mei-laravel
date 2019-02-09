<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';

    protected $fillable = [
        'nome', 'empresario_id', 'abertura', 'setor_id', 'cnpj', 'cnae', 
        'senha_nfse', 'senha_simples_nacional', 'outros',
        'numero', 'endereco', 'complemento', 'bairro', 'cidade', 'estado', 'cep'
    ];

    public function Empresario(){
        return $this->hasOne(\App\Empresario::class, 'id', 'empresario_id');
    }

    public function Setor(){
        return $this->hasOne(\App\Setor::class, 'id', 'setor_id');
    }
}