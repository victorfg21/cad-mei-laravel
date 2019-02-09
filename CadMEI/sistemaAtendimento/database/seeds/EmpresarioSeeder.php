<?php

use Illuminate\Database\Seeder;
use App\Cliente;

class EmpresarioSeeder extends Seeder
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
                'nome' => "Iago Caio da Costa",
                'rg' => "10.763.371-1",
                'cpf' => "41632375699",
                'titulo_eleitor' => "176580570230",
                'sexo' => "M",
                'nascimento' => "19960426",
                'email' => "admiagocaiodacosta_@ipk.org.br",
                'celular' => "31981829172",
                'numero' => "762",
                'endereco' => "Saião",
                'bairro' => "Chácaras Madalena",
                'cidade' => "Ipatinga",
                'estado' => "MG",
                'cep' => "35162872",
            ],
            [
                'nome' => "José Breno Oliveira",
                'rg' => "50.760.665-6",
                'cpf' => "58762985221",
                'titulo_eleitor' => "302612660213",
                'sexo' => "M",
                'nascimento' => "19960426",
                'email' => "josebrenooliveira-81@pharmaterra.com.br",
                'celular' => "31981829172",
                'numero' => "444",
                'endereco' => "Rua Pusco Um",
                'bairro' => "Bethânia",
                'cidade' => "Ipatinga",
                'estado' => "MG",
                'cep' => "35164578",
            ],
            [
                'nome' => "Tomás Otávio Ramos",
                'rg' => "30.292.062-6",
                'cpf' => "36355582304",
                'titulo_eleitor' => "740471640230",
                'sexo' => "M",
                'nascimento' => "19960426",
                'email' => "tomasotavioramos_@estevao.ind.br",
                'celular' => "31981829172",
                'numero' => "762",
                'endereco' => "Avenida Forquilha",
                'bairro' => "Chácaras Madalena",
                'cidade' => "Ipatinga",
                'estado' => "MG",
                'cep' => "35164005",
            ],
            [
                'nome' => "Agatha Evelyn Rita Fogaça",
                'rg' => "15.068.337-6",
                'cpf' => "57719377621",
                'titulo_eleitor' => "042735050205",
                'sexo' => "F",
                'nascimento' => "19880426",
                'email' => "aagathaevelynritafogaca@afsn.com.br",
                'celular' => "31998173272",
                'numero' => "424",
                'endereco' => "Rua Manchester",
                'bairro' => "Bethânia",
                'cidade' => "Ipatinga",
                'estado' => "MG",
                'cep' => "35164768",
            ],
        ];
        
        DB::table('empresarios')->insert($dados);
    }
}
