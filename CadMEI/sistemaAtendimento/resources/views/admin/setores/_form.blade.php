<div class="box box-solid box-primary">
    <div class="box-header with-border"> 
        <h3 class="box-title">Dados Gerais</h3>
    </div>
    <div class="box-body">
        <div class="form-group {{ $errors->has('descricao') ? 'has-error' : '' }}">
            <label for="Descricao" class="control-label">Descrição</label>
            <input for="Descricao" class="form-control" type="text" name="descricao" value="{{ isset($registro->descricao) ? $registro->descricao : old('descricao') }}" />
            @if($errors->has('descricao'))
                <small for="Descricao" class="control-label">{{ $errors->first('descricao') }}</small>
            @endif
        </div>        
    </div>
</div>