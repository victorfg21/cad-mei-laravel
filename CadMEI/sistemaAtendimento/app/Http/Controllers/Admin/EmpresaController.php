<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Empresa;
use App\Empresario;
use App\Setor;

class EmpresaController extends Controller
{
    //construtor
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $registros = Empresa::orderBy('nome')->get();
        return view('admin.empresas.index', compact('registros'));
    }

    public function novo()
    {
        $empresario_list = Empresario::orderBy('nome')->get();
        $setor_list = Setor::orderBy('descricao')->get();
        return view('admin.empresas.novo', [
            'empresario_list' => $empresario_list,
            'setor_list' => $setor_list,
        ]);
    }

    public function salvar(Request $req)
    {
        $req->validate([
            'nome' => 'required|max:150',
            'empresario_id' => 'required',
            'cnpj' => 'required',
            'cnae' => 'required',
            'abertura' => 'required',
            'setor_id' => 'required',
            'senha_nfse' => 'required|max:200',
            'senha_simples_nacional' => 'required|max:200',
            'cep' => 'required',
            'endereco' => 'required|max:150',
            'numero' => 'required',
            'bairro' => 'required|max:150',
            'cidade' => 'required|max:150',
            'estado' => 'required|max:2',
        ], $mensagensErro = [
            'required' => 'Campo obrigatório',
            'max' => 'Quantidade caracteres excedido',
            'unique' => 'O :attribute já está cadastrado!\nNão é permitido registro duplicado',
        ]);

        $dados = $req->all();
        $dados['cep'] = str_replace(".", "", str_replace("-", "", $dados['cep']));
        $dados['cnpj'] = str_replace("/", "", str_replace(".", "", str_replace("-", "", $dados['cnpj'])));
        $dados['cnae'] = str_replace("/", "", str_replace(".", "", str_replace("-", "", $dados['cnae'])));
        
        Empresa::create($dados);

        return redirect()->route('admin.empresas');
    }

    public function editar($id)
    {
        $registro = Empresa::find($id);
        $empresario_list = Empresario::orderBy('nome')->get();
        $setor_list = Setor::orderBy('descricao')->get();
        return view('admin.empresas.editar', [
            'registro' => $registro,
            'empresario_list' => $empresario_list,
            'setor_list' => $setor_list,
        ]);
    }

    public function atualizar(Request $req, $id)
    {
        $req->validate([
            'nome' => 'required|max:150',
            'empresario_id' => 'required',
            'cnpj' => 'required|unique:empresas',
            'cnae' => 'required',
            'abertura' => 'required',
            'setor_id' => 'required',
            'senha_nfse' => 'required|max:200',
            'senha_simples_nacional' => 'required|max:200',
            'cep' => 'required',
            'endereco' => 'required|max:150',
            'numero' => 'required',
            'bairro' => 'required|max:150',
            'cidade' => 'required|max:150',
            'estado' => 'required|max:2',
        ], $mensagensErro = [
            'required' => 'Campo obrigatório',
            'max' => 'Quantidade caracteres excedido',
            'unique' => 'O :attribute já está cadastrado!\nNão é permitido registro duplicado',
        ]);

        $dados = $req->all();
        $dados['cep'] = str_replace(".", "", str_replace("-", "", $dados['cep']));
        $dados['cnpj'] = str_replace("/", "", str_replace(".", "", str_replace("-", "", $dados['cnpj'])));
        $dados['cnae'] = str_replace("/", "", str_replace(".", "", str_replace("-", "", $dados['cnae'])));

        Empresa::find($id)->update($dados);

        return redirect()->route('admin.empresas');
    }

    public function deletar(Request $request, $id)
    {
        $request->user()->authorizeRoles('superadministrator');
        Empresa::find($id)->delete();

        return redirect()->route('admin.empresas');
    }
}
