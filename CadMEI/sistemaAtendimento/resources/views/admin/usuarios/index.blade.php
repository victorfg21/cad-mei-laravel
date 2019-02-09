@extends('adminlte::page')

@section('title', 'CadMEI')

@section('content_header')

@stop

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Usuários</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Editar</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($registros as $registro)
                    <tr>
                        <td>{{ $registro->name }}</td>
                        @if($registro->email == 'admin@mail.com')
                            <td></td>
                        @else
                        <td><a href="{{ route('admin.usuarios.editar', $registro->id) }}"><i class="fa fa-edit fa-lg"></i></a></td>
                        @endif
                        @if($registro->email == 'admin@mail.com')
                            <td></td>
                        @else
                            <td><a href="{{ route('admin.usuarios.deletar', $registro->id) }}"><i class="fa fa-trash fa-lg"></i></a></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a class="btn btn-primary btn-lg" href="{{ route('admin.usuarios.novo') }}"><i class="fa fa-plus fa-lg"></i></a>
        </div>
    </div>
</div>

@stop


