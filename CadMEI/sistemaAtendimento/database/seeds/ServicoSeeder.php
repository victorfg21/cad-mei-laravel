<?php

use Illuminate\Database\Seeder;
use App\Servico;

class ServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados = [
            [
                'descricao' => "FORMALIZAÇÃO",
            ],
            [
                'descricao' => "EMISSÃO DAS",
            ],
            [
                'descricao' => "EMISSÃO NFe",
            ],
            [
                'descricao' => "DECLARAÇÃO ANUAL",
            ],
            [
                'descricao' => "CARTÃO CNPJ",
            ],
            [
                'descricao' => "BAIXA/ENCERRAMENTO",
            ],
            [
                'descricao' => "ORIENTAÇÕES",
            ],
            [
                'descricao' => "SOLICITAÇÃO SENHA PORTEIRINHA",
            ],
            [
                'descricao' => "ATUALIZAÇÃO DE INFORMAÇÕES",
            ],
            [
                'descricao' => "ANÁLISE DE VIABILIDADE",
            ],
            [
                'descricao' => "PARCELAMENTO",
            ],
            [
                'descricao' => "EVENTO",
            ],
            [
                'descricao' => "EMISSÃO DE CND TRABALHISTA",
            ],
            [
                'descricao' => "REGULARIZAÇÃO",
            ],
            [
                'descricao' => "CONSULTORIA",
            ],
            [
                'descricao' => "SOLICITAÇÃO DE CONECTIVIDADE SOCIAL",
            ],
            [
                'descricao' => "EMISSÃO CND ESTADUAL",
            ],
            [
                'descricao' => "EMISSÃO CND FEDERAL",
            ],
            [
                'descricao' => "OUTROS SERVIÇOS",
            ],
            [
                'descricao' => "EMISSÃO CND FGTS",
            ],
            [
                'descricao' => "EMISSÃO CND JUDICIAL",
            ],
        ];
        
        DB::table('servicos')->insert($dados);
    }
}
