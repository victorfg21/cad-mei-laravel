<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;

class UsuarioController extends Controller
{
    //construtor
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles('superadministrator');
        $registros = User::orderBy('name')->get();
        return view('admin.usuarios.index', compact('registros'));
    }

    public function novo()
    {
        $permissao_list = Role::orderBy('description')->get();
        return view('admin.usuarios.novo', [
            'permissao_list' => $permissao_list,
        ]);
    }

    public function salvar(Request $req)
    {
        $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required', 
        ], $mensagensErro = [
            'required' => 'Campo obrigatório',
            'min' => 'Tamanho mínimo 6 caracteres',
            'unique' => 'O :attribute já está cadastrado!\nNão é permitido registro duplicado',
        ]);

        $data = $req->all();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user
       ->roles()
       ->attach(Role::where('id', $data['role_id'])->first());

        return redirect()->route('admin.usuarios');
    }

    public function editar($id)
    {
        $registro = User::find($id);
        $permissao_list = Role::orderBy('description')->get();
        return view('admin.usuarios.editar', [
            'registro' => $registro,
            'permissao_list' => $permissao_list,
        ]);
    }

    public function atualizar(Request $req, $id)
    {
        $req->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'role_id' => 'required',        
        ], $mensagensErro = [
            'required' => 'Campo obrigatório',
            'min' => 'Tamanho mínimo 6 caracteres',
            'unique' => 'O :attribute já está cadastrado!\nNão é permitido registro duplicado',
        ]);

        $data = $req->all();

        $user = User::find($id);

        if($user['password'] === $data['password']){
            $password = $user['password'];
        }
        else {
            $password = bcrypt($data['password']);
        }

        $user = User::find($id)->update([
            'name' => $data['name'],
            'password' => $password,
        ]);
        
        DB::table('role_user')
            ->where('user_id', $user['id'])
            ->update(['role_id' => $data['role_id']]);

        return redirect()->route('admin.usuarios');
    }

    public function deletar(Request $request, $id)
    {
        $request->user()->authorizeRoles('superadministrator');
        User::find($id)->delete();
        DB::table('role_user')->where('user_id', '=', $id)->delete();

        return redirect()->route('admin.usuarios');
    }
}
