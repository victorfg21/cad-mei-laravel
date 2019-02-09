@extends('adminlte::page')

@section('title', 'CadMEI')

@section('content_header')

@stop

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Histórico de Atendimentos</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped tabela-pesquisa">
                <thead class="thead-dark">
                    <tr>
                        <th class="col-xs-2">ID</th>
                        <th class="col-xs-2">CNPJ</th>
                        <th class="col-xs-6">Serviços</th>
                        <th class="col-xs-2">Data Atendimento</th>
                        <th class="col-xs-1">Visualizar</th>
                        <th class="col-xs-1">Remover</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($registros as $registro)
                    <tr>
                        <td><span class="cnpj">{{ isset($registro->id) ? $registro->id : '' }}</span></td>
                        <td><span class="cnpj">{{ isset($registro->cnpj) ? $registro->cnpj : '' }}</span></td>
                        <td>{{ isset($list_servicos[$loop->index]) ? $list_servicos[$loop->index] : '' }}</td>
                        <td><span class="data">{{ isset($registro->data) ? $registro->data : '' }}</span></td>
                        <td><a href="{{ route('admin.atendimentos.detalhe', $registro->id) }}"><i class="fa fa-eye fa-lg"></i></a></td>
                        <td><a href="{{ route('admin.atendimentos.deletar', $registro->id) }}"><i class="fa fa-trash fa-lg"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a class="btn btn-primary btn-lg" href="{{ route('admin.atendimentos.novo') }}"><i class="fa fa-plus fa-lg"></i></a>
        </div>
    </div>
</div>

@stop
