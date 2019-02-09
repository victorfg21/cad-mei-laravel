<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AtendimentoServicos extends Model
{
    protected $table = 'atendimento_servicos';

    public $timestamps = false;

    protected $fillable = [
        'servico_id'
    ];

    public function Servico(){
        return $this->hasOne(\App\Servico::class, 'id', 'servico_id');
    }

    public function Atendimento(){
        return $this->hasOne(\App\Atendimento::class, 'id', 'atendimento_id');
    }
}