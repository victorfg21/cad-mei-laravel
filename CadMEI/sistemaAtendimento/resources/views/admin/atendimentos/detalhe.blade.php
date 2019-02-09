@extends('adminlte::page')

@section('title', 'CadMEI')

@section('content_header')

@stop

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Detalhe Atendimento</h3>
    </div>
    <div class="box-body">
        @include('admin.atendimentos._form_detalhe')
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <a class="link-generico" href="{{ route('admin.atendimentos') }}"><i class="fa fa-arrow-circle-left fa-lg"></i>  Retornar para listagem</a>
    </div>
</div>

@stop

