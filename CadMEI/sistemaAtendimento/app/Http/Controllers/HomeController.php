<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Empresario;
use App\Atendimento;
use App\AtendimentoServicos;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados_servicos = DB::table('atendimentos')
                        ->leftJoin('atendimento_servicos', 'atendimentos.id', '=', 'atendimento_servicos.atendimento_id')
                        ->leftJoin('servicos', 'atendimento_servicos.servico_id', '=', 'servicos.id')
                        ->groupby('servicos.descricao')
                        ->orderby('servicos.descricao')
                        ->select(DB::raw('servicos.descricao, COUNT(atendimento_servicos.atendimento_id) AS qtd'))
                        ->get();

        $dados_empresas = DB::table('empresas')
                            ->select(DB::raw('COUNT(empresas.id) AS qtd'))
                            ->first();

        $dados_empresarios = DB::table('empresarios')
                            ->select(DB::raw('COUNT(empresarios.id) AS qtd'))
                            ->first();
        
        return view('home', [
            'dados_servicos' => $dados_servicos,
            'dados_empresas' => $dados_empresas,
            'dados_empresarios' => $dados_empresarios,
        ]);
    }
}

