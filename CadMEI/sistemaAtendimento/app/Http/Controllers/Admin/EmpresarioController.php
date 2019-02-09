<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Empresario;

class EmpresarioController extends Controller
{
    //construtor
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $registros = Empresario::orderBy('nome')->get();
        return view('admin.empresarios.index', compact('registros'));
    }

    public function novo()
    {
        return view('admin.empresarios.novo');
    }

    public function salvar(Request $req)
    {
        $req->validate([
            'nome' => 'required|max:150',
            'rg' => 'required|max:20|unique:empresarios',
            'cpf' => 'required|unique:empresarios',
            'titulo_eleitor' => 'required|unique:empresarios',
            'nascimento' => 'required',
            'sexo' => 'required',
            'email' => 'email|max:200',
            'celular' => 'required',
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
        $dados['cpf'] = str_replace(".", "",str_replace("-", "", $dados['cpf']));
        $dados['telefone'] = str_replace(" ", "", str_replace("-", "", str_replace(")", "", str_replace("(", "", $dados['telefone']))));
        $dados['celular'] = str_replace(" ", "", str_replace("-", "", str_replace(")", "", str_replace("(", "", $dados['celular']))));

        Empresario::create($dados);

        return redirect()->route('admin.empresarios');
    }

    public function editar($id)
    {
        $registro = Empresario::find($id);
        return view('admin.empresarios.editar', compact('registro'));
    }

    public function atualizar(Request $req, $id)
    {
        $req->validate([
            'nome' => 'required|max:150',
            'rg' => 'required|max:20',
            'cpf' => 'required',
            'titulo_eleitor' => 'required',
            'nascimento' => 'required',
            'sexo' => 'required',
            'email' => 'required|string|email|max:255',
            'celular' => 'required',
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
            'email' => 'O email não é valido',
        ]);         

        $dados = $req->all();
        $dados['cep'] = str_replace(".", "", str_replace("-", "", $dados['cep']));
        $dados['cpf'] = str_replace(".", "",str_replace("-", "", $dados['cpf']));
        $dados['telefone'] = str_replace(" ", "", str_replace("-", "", str_replace(")", "", str_replace("(", "", $dados['telefone']))));
        $dados['celular'] = str_replace(" ", "", str_replace("-", "", str_replace(")", "", str_replace("(", "", $dados['celular']))));

        Empresario::find($id)->update($dados);

        return redirect()->route('admin.empresarios');
    }

    public function deletar(Request $request, $id)
    {
        $request->user()->authorizeRoles('superadministrator');
        Empresario::find($id)->delete();

        return redirect()->route('admin.empresarios');
    }
}
