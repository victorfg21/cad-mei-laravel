<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    protected $table = 'atendimentos';

    protected $fillable = [
        'empresa_id', 'data', 'hora', 
        'ano_declaracao', 'valor_total', 'observacao',
    ];

    public function AtendimentoServicos(){
        return $this->hasMany(\App\AtendimentoServicos::class);
    }

    public function Empresa(){
        return $this->belongsTo(\App\Empresa::class, 'id', 'empresa_id');
    }
}