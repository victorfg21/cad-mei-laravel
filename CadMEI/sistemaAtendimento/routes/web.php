<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function(){
    return view('auth/login');
});

Route::get('home', ['as' => 'home', 'uses' => 'HomeController@index']);

//Usuário
Route::get('admin/usuarios', ['as' => 'admin.usuarios', 'uses' => 'Admin\UsuarioController@index']);
Route::get('admin/usuarios/novo', ['as' => 'admin.usuarios.novo', 'uses' => 'Admin\UsuarioController@novo']);
Route::post('admin/usuarios/salvar', ['as' => 'admin.usuarios.salvar', 'uses' => 'Admin\UsuarioController@salvar']);
Route::get('admin/usuarios/editar/{id}', ['as' => 'admin.usuarios.editar', 'uses' => 'Admin\UsuarioController@editar']);
Route::put('admin/usuarios/atualizar/{id}', ['as' => 'admin.usuarios.atualizar', 'uses' => 'Admin\UsuarioController@atualizar']);
Route::get('admin/usuarios/deletar/{id}', ['as' => 'admin.usuarios.deletar', 'uses' => 'Admin\UsuarioController@deletar']);

//Cliente
Route::get('admin/empresarios', ['as' => 'admin.empresarios', 'uses' => 'Admin\EmpresarioController@index']);
Route::get('admin/empresarios/novo', ['as' => 'admin.empresarios.novo', 'uses' => 'Admin\EmpresarioController@novo']);
Route::post('admin/empresarios/salvar', ['as' => 'admin.empresarios.salvar', 'uses' => 'Admin\EmpresarioController@salvar']);
Route::get('admin/empresarios/editar/{id}', ['as' => 'admin.empresarios.editar', 'uses' => 'Admin\EmpresarioController@editar']);
Route::put('admin/empresarios/atualizar/{id}', ['as' => 'admin.empresarios.atualizar', 'uses' => 'Admin\EmpresarioController@atualizar']);
Route::get('admin/empresarios/deletar/{id}', ['as' => 'admin.empresarios.deletar', 'uses' => 'Admin\EmpresarioController@deletar']);

//Empresa
Route::get('admin/empresas', ['as' => 'admin.empresas', 'uses' => 'Admin\EmpresaController@index']);
Route::get('admin/empresas/novo', ['as' => 'admin.empresas.novo', 'uses' => 'Admin\EmpresaController@novo']);
Route::post('admin/empresas/salvar', ['as' => 'admin.empresas.salvar', 'uses' => 'Admin\EmpresaController@salvar']);
Route::get('admin/empresas/editar/{id}', ['as' => 'admin.empresas.editar', 'uses' => 'Admin\EmpresaController@editar']);
Route::put('admin/empresas/atualizar/{id}', ['as' => 'admin.empresas.atualizar', 'uses' => 'Admin\EmpresaController@atualizar']);
Route::get('admin/empresas/deletar/{id}', ['as' => 'admin.empresas.deletar', 'uses' => 'Admin\EmpresaController@deletar']);

//Serviço
Route::get('admin/servicos', ['as' => 'admin.servicos', 'uses' => 'Admin\ServicoController@index']);
Route::get('admin/servicos/novo', ['as' => 'admin.servicos.novo', 'uses' => 'Admin\ServicoController@novo']);
Route::post('admin/servicos/salvar', ['as' => 'admin.servicos.salvar', 'uses' => 'Admin\ServicoController@salvar']);
Route::get('admin/servicos/editar/{id}', ['as' => 'admin.servicos.editar', 'uses' => 'Admin\ServicoController@editar']);
Route::put('admin/servicos/atualizar/{id}', ['as' => 'admin.servicos.atualizar', 'uses' => 'Admin\ServicoController@atualizar']);
Route::get('admin/servicos/deletar/{id}', ['as' => 'admin.servicos.deletar', 'uses' => 'Admin\ServicoController@deletar']);

//Setor
Route::get('admin/setores', ['as' => 'admin.setores', 'uses' => 'Admin\SetorController@index']);
Route::get('admin/setores/novo', ['as' => 'admin.setores.novo', 'uses' => 'Admin\SetorController@novo']);
Route::post('admin/setores/salvar', ['as' => 'admin.setores.salvar', 'uses' => 'Admin\SetorController@salvar']);
Route::get('admin/setores/editar/{id}', ['as' => 'admin.setores.editar', 'uses' => 'Admin\SetorController@editar']);
Route::put('admin/setores/atualizar/{id}', ['as' => 'admin.setores.atualizar', 'uses' => 'Admin\SetorController@atualizar']);
Route::get('admin/setores/deletar/{id}', ['as' => 'admin.setores.deletar', 'uses' => 'Admin\SetorController@deletar']);

//Historico Atendimento
Route::get('admin/atendimentos', ['as' => 'admin.atendimentos', 'uses' => 'Admin\AtendimentoController@index']);
Route::get('admin/atendimentos/novo', ['as' => 'admin.atendimentos.novo', 'uses' => 'Admin\AtendimentoController@novo']);
Route::post('admin/atendimentos/salvar', ['as' => 'admin.atendimentos.salvar', 'uses' => 'Admin\AtendimentoController@salvar']);
Route::get('admin/atendimentos/detalhe/{id}', ['as' => 'admin.atendimentos.detalhe', 'uses' => 'Admin\AtendimentoController@detalhe']);
Route::get('admin/atendimentos/deletar/{id}', ['as' => 'admin.atendimentos.deletar', 'uses' => 'Admin\AtendimentoController@deletar']);

//Historico Atendimento
Route::get('admin/relatorios', ['as' => 'admin.relatorios', 'uses' => 'Admin\RelatorioController@index']);
Route::post('admin/relatorios/servicos', ['as' => 'admin.relatorios.servicos', 'uses' => 'Admin\RelatorioController@servicos']);
Route::post('admin/relatorios/empresas', ['as' => 'admin.relatorios.empresas', 'uses' => 'Admin\RelatorioController@empresas']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
