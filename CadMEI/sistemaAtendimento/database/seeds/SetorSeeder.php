<?php

use Illuminate\Database\Seeder;
use App\Setor;

class SetorSeeder extends Seeder
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
                'descricao' => "INDUSTRIA MECÂNICA",
            ],
            [
                'descricao' => "ALIMENTÍCIO",
            ],
            [
                'descricao' => "TI",
            ],
        ];
        
        DB::table('setores')->insert($dados);
    }
}
