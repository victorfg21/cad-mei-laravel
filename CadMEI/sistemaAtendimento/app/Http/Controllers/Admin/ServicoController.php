<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Servico;

class ServicoController extends Controller
{
    //construtor
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles('superadministrator');
        $registros = Servico::orderBy('descricao')->get();
        return view('admin.servicos.index', compact('registros'));
    }

    public function novo(Request $request)
    {
        $request->user()->authorizeRoles('superadministrator');
        return view('admin.servicos.novo');
    }

    public function salvar(Request $req)
    {
        $req->validate([
            'descricao' => 'required|max:150',
        ], $mensagensErro = [
            'required' => 'Campo obrigatório',
            'max' => 'Quantidade caracteres excedido',
        ]);  

        $dados = $req->all();
        Servico::create($dados);

        return redirect()->route('admin.servicos');
    }

    public function editar(Request $request, $id)
    {
        $request->user()->authorizeRoles('superadministrator');
        $registro = Servico::find($id);
        return view('admin.servicos.editar', compact('registro'));
    }

    public function atualizar(Request $req, $id)
    {
        $req->validate([
            'descricao' => 'required|max:150',
        ], $mensagensErro = [
            'required' => 'Campo obrigatório',
            'max' => 'Quantidade caracteres excedido',
        ]);

        $dados = $req->all();
        Servico::find($id)->update($dados);

        return redirect()->route('admin.servicos');
    }

    public function deletar(Request $request, $id)
    {
        $request->user()->authorizeRoles('superadministrator');
        Servico::find($id)->delete();

        return redirect()->route('admin.servicos');
    }
}
