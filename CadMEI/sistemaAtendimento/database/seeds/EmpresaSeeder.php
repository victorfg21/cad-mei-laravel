<?php

use Illuminate\Database\Seeder;
use App\Empresa;

class EmpresaSeeder extends Seeder
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
                'nome' => "AltTec Ltda",
                'empresario_id' => "1",
                'cnpj' => "07407872000118",
                'abertura' => "20151001",
                'setor_id' => "3",
                'cnae' => "7254812",
                'senha_nfse' => "DsqL7SJs", 
                'senha_simples_nacional' => "xo9fLqLS",
                'numero' => "70",
                'endereco' => "Rua Âmbar",
                'bairro' => "Iguaçu",
                'cidade' => "Ipatinga",
                'estado' => "MG",
                'cep' => "35162019",
            ],
            [
                'nome' => "ThreeAço",
                'empresario_id' => "2",
                'cnpj' => "11916538000167",
                'abertura' => "20150318",
                'setor_id' => "1",
                'cnae' => "2153102",
                'senha_nfse' => "kjUYeS1U", 
                'senha_simples_nacional' => "70fyJWmJ",
                'numero' => "421",
                'endereco' => "Rua Graúnas",
                'bairro' => "São Pedro",
                'cidade' => "Juiz de Fora",
                'estado' => "MG",
                'cep' => "36036468",
            ],
            [
                'nome' => "Bazar Frangos",
                'empresario_id' => "2",
                'cnpj' => "69901053000180",
                'abertura' => "20141023",
                'setor_id' => "1",
                'cnae' => "0254112",
                'senha_nfse' => "RMFz2I7x", 
                'senha_simples_nacional' => "M850NeJ8",
                'numero' => "290",
                'endereco' => "Avenida A",
                'bairro' => "Juliana",
                'cidade' => "Belo Horizonte",
                'estado' => "MG",
                'cep' => "31744620",
            ],
        ];
        
        DB::table('empresas')->insert($dados);
    }
}
