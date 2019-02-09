<div class="box box-solid box-primary">
    <div class="box-header with-border"> 
        <h3 class="box-title">Dados Gerais</h3>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label for="CNPJ" class="control-label">CNPJ</label>
            <select for="Servicos" class="form-control js-example-basic-single" name="empresa_id" disabled>
                @foreach ($empresa_list as $item => $empresa)
                    @if($registro->empresa_id == $empresa->id)
                        <option class="cnpj" value="{{ $empresa->id }}">{{ $empresa->cnpj }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="Data" class="control-label">Data</label>
            <input for="Data" class="form-control data" type="text" name="data" value="{{ date("d/m/Y") }}" disabled/>
        </div>
        <div class="form-group">
            <label for="Hora" class="control-label">Hora</label>
            <input for="Hora" class="form-control hora" type="text" name="hora" value="{{ date("H:i:s") }}" disabled/>
        </div>
        <div class="form-group">
            <label for="Servicos" class="control-label">Serviços</label>
            <textarea for="Servicos" class="form-control" rows="4" cols="50" name="servicos" disabled>{{ isset($servicos) ? $servicos : '' }}</textarea>
        </div> 
        <div class="form-group">
            <label for="Ano" class="control-label">Ano Declaração</label>
            <input for="Ano" class="form-control ano" type="text" name="ano_declaracao" value="{{ isset($registro->ano_declaracao) ? $registro->ano_declaracao : '' }}" disabled/>
        </div>
        <div class="form-group">
            <label for="Valor" class="control-label">Valor Total</label>
            <input for="Valor" class="form-control dinheiro" type="text" name="valor_total" value="{{ isset($registro->valor_total) ? $registro->valor_total : '' }}" disabled/>
        </div>
        <div class="form-group">
            <label for="Observacao" class="control-label">Observação</label>
            <textarea for="Observacao" class="form-control" rows="4" cols="50" name="observacao" disabled>{{ isset($registro->observacao) ? $registro->observacao : '' }}</textarea>
        </div>     
    </div>
</div>
    