<div class="box box-solid box-primary">
    <div class="box-header with-border"> 
        <h3 class="box-title">Dados Gerais</h3>
    </div>
    <div class="box-body">
        <div class="form-group {{ $errors->has('empresa_id') ? 'has-error' : '' }}">
            <label for="CNPJ" class="control-label">CNPJ</label>
            <select for="Servicos" class="form-control js-example-basic-single" name="empresa_id">
                <option value="" selected></option>
                @foreach ($empresa_list as $item => $empresa)
                    <option class="cnpj" value="{{ $empresa->id }}">{{ $empresa->cnpj }}</option>
                @endforeach
            </select>
            @if($errors->has('empresa_id'))
                <small for="CNPJ" class="control-label">{{ $errors->first('empresa_id') }}</small>
            @endif
        </div>
        <div class="form-group">
            <label for="Data" class="control-label">Data</label>
            <input for="Data" class="form-control data" type="text" name="data" value="{{ date("d/m/Y") }}" readonly/>
        </div>
        <div class="form-group">
            <label for="Hora" class="control-label">Hora</label>
            <input for="Hora" class="form-control hora" type="text" name="hora" value="{{ date("H:i:s") }}" readonly/>
        </div>
        <div class="form-group {{ $errors->has('servicos') ? 'has-error' : '' }}">
            <label for="Servicos" class="control-label">Serviços</label>
            <select for="Servicos" class="form-control js-example-basic-multiple servicos" id="servicos" name="servicos[]" multiple="multiple">
                @foreach ($servico_list as $item => $servico)
                    <option value="{{ $servico->id }}">{{ $servico->descricao }}</option>
                @endforeach
            </select>
            @if($errors->has('servicos'))
                <small for="Servicos" class="control-label">{{ $errors->first('servicos') }}</small>
            @endif
        </div>
        <div class="form-group {{ $errors->has('ano_declaracao') ? 'has-error' : '' }}">
            <label for="Ano" class="control-label">Ano Declaração</label>
            <input for="Ano" class="form-control ano" type="text" name="ano_declaracao" value="{{ isset($registro->ano_declaracao) ? $registro->ano_declaracao : old('ano_declaracao') }}" readonly />
            @if($errors->has('ano_declaracao'))
                <small for="Ano" class="control-label">{{ $errors->first('ano_declaracao') }}</small>
            @endif
        </div>
        <div class="form-group {{ $errors->has('valor_total') ? 'has-error' : '' }}">
            <label for="Valor" class="control-label">Valor Total</label>
            <input for="Valor" class="form-control dinheiro" type="text" name="valor_total" value="{{ isset($registro->valor_total) ? $registro->valor_total : old('valor_total') }}" readonly />
            @if($errors->has('valor_total'))
                <small for="Valor" class="control-label">{{ $errors->first('valor_total') }}</small>
            @endif
        </div>
        <div class="form-group {{ $errors->has('observacao') ? 'has-error' : '' }}">
            <label for="Observacao" class="control-label">Observação</label>
            <textarea for="Observacao" class="form-control" rows="4" cols="50" name="observacao">{{ isset($registro->observacao) ? $registro->observacao : old('observacao') }}</textarea>
            @if($errors->has('observacao'))
                <small for="Observacao" class="control-label">{{ $errors->first('observacao') }}</small>
            @endif
        </div>     
    </div>
</div>

<script>
    $('.js-example-basic-multiple').on('change', function (e) { 
        servicos = $('#servicos').find(':selected');
        
        for (let i = 0; i < servicos.length; i++) {
            if(servicos[i].value == 4){
                $('input[name="ano_declaracao"]').prop('readonly', false);
                $('input[name="valor_total"]').prop('readonly', false);
                break;
            }else{
                $('input[name="ano_declaracao"]').prop('readonly', true);
                $('input[name="ano_declaracao"]').val('');
                $('input[name="valor_total"]').prop('readonly', true);
                $('input[name="valor_total"]').val('');
            }
        }        
    });
</script>