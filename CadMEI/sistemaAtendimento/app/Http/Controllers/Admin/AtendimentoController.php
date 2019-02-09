<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Util\Metodos;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Atendimento;
use App\AtendimentoServicos;
use App\Empresa;
use App\Servico;

class AtendimentoController extends Controller
{
    //construtor
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $registros = Atendimento::orderBy('data')
                                ->join('empresas', 'atendimentos.empresa_id', '=', 'empresas.id')
                                ->select('atendimentos.id', 'empresas.cnpj', 'atendimentos.data', 'atendimentos.observacao')
                                ->get();

        $servicos = "";
        $list_servicos = array();
        for ($i=0; $i < Count($registros); $i++) {
            
            $registros_linha = AtendimentoServicos::where('atendimento_id', '=', $registros[$i]['id'])
                                ->leftJoin('servicos', 'atendimento_servicos.servico_id', '=', 'servicos.id')
                                ->select('atendimento_servicos.id', 'servicos.descricao')
                                ->get();

            for ($j=0; $j < Count($registros_linha); $j++) {
                if ($j + 1 == Count($registros_linha)) {
                    $servicos .= $registros_linha[$j]['descricao'];
                } else {
                    $servicos .= $registros_linha[$j]['descricao'] . ", ";
                }
            }  
            
            array_push($list_servicos, $servicos);
            $servicos = "";
        }

        return view('admin.atendimentos.index', [
            'registros' => $registros,
            'list_servicos' => $list_servicos,
        ]);
    }

    public function novo()
    {
        $empresa_list = Empresa::orderBy('cnpj')->get();
        $servico_list = Servico::orderBy('descricao')->get();
        return view('admin.atendimentos.novo', [
            'empresa_list' => $empresa_list,
            'servico_list' => $servico_list,
        ]);
    }

    public function salvar(Request $req)
    {
        $req->validate([
            'empresa_id' => 'required',
            'servicos' => 'required',
        ], $mensagensErro = [
            'required' => 'Campo obrigatório',
            'max' => 'Quantidade caracteres excedido',
            'unique' => 'O :attribute já está cadastrado!\nNão é permitido registro duplicado',
        ]);

        $metodos = new Metodos();
        $dados = $req->all();

        $valorTotal = $metodos->moeda($dados['valor_total']);        
        if(!isset($dados['valor_total']) || empty($dados['valor_total'])){
            $valorTotal = null;
        }

        if(!isset($dados['ano_declaracao']) || empty($dados['ano_declaracao'])){
            $ano_declaracao = null;
        }else {
            $ano_declaracao = $dados['ano_declaracao'];
        }
        
        $idAtendimento = Atendimento::create([
            'empresa_id' => $dados['empresa_id'],
            'data' => $dados['data'],
            'hora' => $dados['hora'],
            'ano_declaracao' => $ano_declaracao,
            'valor_total' => $valorTotal,
            'observacao' => $dados['observacao'],
        ]);

        $atendimento = Atendimento::find($idAtendimento['id']);
        
        foreach ($dados['servicos'] as $idServico) {
            $atendimento->AtendimentoServicos()->create([
                'atendimento_id' => $idAtendimento,
                'servico_id' => intval($idServico)
            ]);
        }

        return redirect()->route('admin.atendimentos');
    }

    public function detalhe($id)
    {
        $metodos = new Metodos();
        $registro = Atendimento::find($id);
        $registros_linha = AtendimentoServicos::where('atendimento_id', '=', $id)
                                              ->leftJoin('servicos', 'atendimento_servicos.servico_id', '=', 'servicos.id')
                                              ->select('atendimento_servicos.id', 'servicos.descricao')
                                              ->get();

        $servicos = "";
        for ($i=0; $i < Count($registros_linha); $i++) {
            if ($i + 1 == Count($registros_linha)) {
                $servicos .= $registros_linha[$i]['descricao'];
            } else {
                $servicos .= $registros_linha[$i]['descricao'] . ", ";
            }
        }
        $registro['valor_total'] = str_replace('.', ',', $registro['valor_total']);

        $empresa_list = Empresa::orderBy('cnpj')->get();
        return view('admin.atendimentos.detalhe', [
            'registro' => $registro,
            'servicos' => $servicos,
            'empresa_list' => $empresa_list,
        ]);
    }

    public function deletar(Request $request, $id)
    {
        $request->user()->authorizeRoles('superadministrator');
        AtendimentoServicos::where('atendimento_id', '=', $id)->delete();
        Atendimento::find($id)->delete();

        return redirect()->route('admin.atendimentos');
    }
}
