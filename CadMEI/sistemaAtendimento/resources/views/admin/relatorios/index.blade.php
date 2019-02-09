@extends('adminlte::page')

@section('title', 'CadMEI')

@section('content_header')

@stop

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h1 class="box-title">Relatórios</h1>
    </div>
    <div class="box-body">
        <div class="box-header with-border">
            <h4 class="box-title">Serviços x Período</h4>
        </div>
        <div class="box-body">
            <form action="{{ route('admin.relatorios.servicos') }}" method="POST" enctype="multipart/form-data" target="_blank">
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-md-4 {{ $errors->has('servico_ret') ? 'has-error' : '' }}">
                        <label for="Servicos" class="control-label">Serviços</label>
                        <select for="Servicos" class="form-control js-example-basic-single servicos" name="servico_ret">
                            @foreach ($servico_list as $item => $servico)
                                <option value="{{ $servico->id }}">{{ $servico->descricao }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('servico_ret'))
                            <small for="Servicos" class="control-label">{{ $errors->first('servico_ret') }}</small>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-2 {{ $errors->has('inicioServico') ? 'has-error' : '' }}">
                        <label for="DataFim" class="control-label">Início</label>
                        <input for="DataFim" class="form-control" type="date" name="inicioServico" value="" placeholder="DD/MM/YYYY"/>
                        @if($errors->has('inicioServico'))
                            <small for="DataFim" class="control-label">{{ $errors->first('inicioServico') }}</small>
                        @endif
                    </div>
                    <div class="form-group col-md-2 {{ $errors->has('fimServico') ? 'has-error' : '' }}">
                        <label for="DataIni" class="control-label">Fim</label>
                        <input for="DataIni" class="form-control" type="date" name="fimServico" value="" placeholder="DD/MM/YYYY"/>
                        @if($errors->has('fimServico'))
                            <small for="DataIni" class="control-label">{{ $errors->first('fimServico') }}</small>
                        @endif
                    </div>
                </div>
                <input type="submit" value="Gerar" class="btn btn-info" tar />
            </form>
        </div>
        <div class="box-header with-border">
            <h4 class="box-title">Empresas x Setor</h4>
        </div>
        <div class="box-body">
            <form action="{{ route('admin.relatorios.empresas') }}" method="POST" enctype="multipart/form-data" target="_blank">
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-md-2 {{ $errors->has('inicioEmpresa') ? 'has-error' : '' }}">
                        <label for="DataIniEmp" class="control-label">Início</label>
                        <input for="DataIniEmp" class="form-control" type="date" name="inicioEmpresa" value="" placeholder="DD/MM/YYYY"/>
                        @if($errors->has('inicioEmpresa'))
                            <small for="DataIniEmp" class="control-label">{{ $errors->first('inicioEmpresa') }}</small>
                        @endif
                    </div>
                    <div class="form-group col-md-2 {{ $errors->has('fimEmpresa') ? 'has-error' : '' }}">
                        <label for="DataFimEmp" class="control-label">Fim</label>
                        <input for="DataFimEmp" class="form-control" type="date" name="fimEmpresa" value="" placeholder="DD/MM/YYYY"/>
                        @if($errors->has('fimEmpresa'))
                            <small for="DataFimEmp" class="control-label">{{ $errors->first('fimEmpresa') }}</small>
                        @endif
                    </div>
                </div>
                <input type="submit" value="Gerar" class="btn btn-info" />
            </form>
        </div>
    </div>
</div>

@stop
