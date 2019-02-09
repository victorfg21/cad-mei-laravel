<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Setor;

class SetorController extends Controller
{
    //construtor
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles('superadministrator');
        $registros = Setor::orderBy('descricao')->get();
        return view('admin.setores.index', compact('registros'));
    }

    public function novo(Request $request)
    {
        $request->user()->authorizeRoles('superadministrator');
        return view('admin.setores.novo');
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
        Setor::create($dados);

        return redirect()->route('admin.setores');
    }

    public function editar(Request $request, $id)
    {
        $request->user()->authorizeRoles('superadministrator');
        $registro = Setor::find($id);
        return view('admin.setores.editar', compact('registro'));
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
        Setor::find($id)->update($dados);

        return redirect()->route('admin.setores');
    }

    public function deletar(Request $request, $id)
    {
        $request->user()->authorizeRoles('superadministrator');
        Setor::find($id)->delete();

        return redirect()->route('admin.setores');
    }
}
