<div class="box box-solid box-primary">
    <div class="box-header with-border"> 
        <h3 class="box-title">Dados Gerais</h3>
    </div>
    <div class="box-body">
        <div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">
            <label for="Nome" class="control-label">Nome</label>
            <input for="Nome" class="form-control" type="text" name="nome" value="{{ isset($registro->nome) ? $registro->nome : old('nome') }}" />
            @if($errors->has('nome'))
                <small for="Nome" class="control-label">{{ $errors->first('nome') }}</small>
            @endif
        </div>
        <div class="form-group {{ $errors->has('empresario_id') ? 'has-error' : '' }}">
            <label for="Empresario" class="control-label">Empresário</label>
            <select for="Empresario" class="form-control js-example-basic-single" name="empresario_id">
                @if(!isset($registro->empresario_id))
                    <option value="" selected></option>
                    @foreach ($empresario_list as $empresario)
                        <option value="{{ $empresario->id }}">{{ $empresario->nome }}</option>                        
                    @endforeach
                @else
                {
                    @foreach ($empresario_list as $empresario)
                        @if($empresario->id == $registro->empresario_id)
                            <option value="{{ $empresario->id }}" selected>{{ $empresario->nome }}</option>
                        @else
                            <option value="{{ $empresario->id }}">{{ $empresario->nome }}</option>
                        @endif                        
                    @endforeach
                }
                @endif
            </select>
            @if($errors->has('empresario_id'))
                <small for="Empresario" class="control-label">{{ $errors->first('empresario_id') }}</small>
            @endif
        </div>
        <div class="form-group {{ $errors->has('cnpj') ? 'has-error' : '' }}">
            <label for="CNPJ" class="control-label">CNPJ</label>
            <input for="CNPJ" class="form-control cnpj" type="text" name="cnpj" value="{{ isset($registro->cnpj) ? $registro->cnpj : old('cnpj') }}" />
            @if($errors->has('cnpj'))
                <small for="CNPJ" class="control-label">{{ $errors->first('cnpj') }}</small>
            @endif
        </div>
        <div class="form-group {{ $errors->has('cnae') ? 'has-error' : '' }}">
            <label for="CNAE" class="control-label">CNAE</label>
            <input for="CNAE" class="form-control cnae" type="text" name="cnae" value="{{ isset($registro->cnae) ? $registro->cnae : old('cnae') }}" />
            @if($errors->has('cnae'))
                <small for="CNAE" class="control-label">{{ $errors->first('cnae') }}</small>
            @endif
        </div>
        <div class="form-group {{ $errors->has('abertura') ? 'has-error' : '' }}">
            <label for="Abertura" class="control-label">Data Abertura</label>
            <input for="Abertura" class="form-control data" type="text" name="abertura" value="{{ isset($registro->abertura) ? date('d-m-Y', strtotime($registro->abertura)) : old('abertura') }}" />
            @if($errors->has('abertura'))
                <small for="Abertura" class="control-label">{{ $errors->first('abertura') }}</small>
            @endif
        </div>
        <div class="form-group {{ $errors->has('setor_id') ? 'has-error' : '' }}">
            <label for="Setor" class="control-label">Setor</label>
            <select for="Setor" class="form-control js-example-basic-single" name="setor_id">
                @if(!isset($registro->setor_id))
                    <option value="" selected></option>
                    @foreach ($setor_list as $setor)
                        <option value="{{ $setor->id }}">{{ $setor->descricao }}</option>                        
                    @endforeach
                @else
                {
                    @foreach ($setor_list as $setor)
                        @if($setor->id == $registro->setor_id)
                            <option value="{{ $setor->id }}" selected>{{ $setor->descricao }}</option>
                        @else
                            <option value="{{ $setor->id }}">{{ $setor->descricao }}</option>
                        @endif                        
                    @endforeach
                }
                @endif
            </select>
            @if($errors->has('setor_id'))
                <small for="Setor" class="control-label">{{ $errors->first('setor_id') }}</small>
            @endif
        </div>
        <div class="form-group {{ $errors->has('senha_nfse') ? 'has-error' : '' }}">
            <label for="SenhaNfse" class="control-label">Senha NFSe</label>
            <input for="SenhaNfse" class="form-control" type="text" name="senha_nfse" value="{{ isset($registro->senha_nfse) ? $registro->senha_nfse : old('senha_nfse') }}" />
            @if($errors->has('senha_nfse'))
                <small for="SenhaNfse" class="control-label">{{ $errors->first('senha_nfse') }}</small>
            @endif
        </div> 
        <div class="form-group {{ $errors->has('senha_simples_nacional') ? 'has-error' : '' }}">
            <label for="SenhaSimples" class="control-label">Senha Simples Nacional</label>
            <input for="SenhaSimples" class="form-control" type="text" name="senha_simples_nacional" value="{{ isset($registro->senha_simples_nacional) ? $registro->senha_simples_nacional : old('senha_simples_nacional') }}" />
            @if($errors->has('senha_simples_nacional'))
                <small for="SenhaSimples" class="control-label">{{ $errors->first('senha_simples_nacional') }}</small>
            @endif
        </div> 
        <div class="form-group {{ $errors->has('outros') ? 'has-error' : '' }}">
            <label for="Outros" class="control-label">Outros</label>
            <input for="Outros" class="form-control" type="text" name="outros" value="{{ isset($registro->outros) ? $registro->outros : old('outros') }}"/>
            @if($errors->has('outros'))
                <small for="Outros" class="control-label">{{ $errors->first('outros') }}</small>
            @endif
        </div>        
    </div>
    <div class="box-header with-border"> 
        <h3 class="box-title">Endereço</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('cep') ? 'has-error' : '' }}">
                    <label for="Cep" class="control-label">CEP</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input for="Cep" class="form-control cep" type="text" name="cep" value="{{ isset($registro->cep) ? $registro->cep : old('cep') }}"/>
                            @if($errors->has('cep'))
                                <small for="Cep" class="control-label">{{ $errors->first('cep') }}</small>
                            @endif
                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-default" id="cep">Buscar CEP</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('endereco') ? 'has-error' : '' }}">
                    <label for="Endereco" class="control-label">Endereço</label>
                    <input for="Endereco" class="form-control" type="text" name="endereco" value="{{ isset($registro->endereco) ? $registro->endereco : old('endereco') }}" />
                    @if($errors->has('endereco'))
                        <small for="Endereco" class="control-label">{{ $errors->first('endereco') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group {{ $errors->has('numero') ? 'has-error' : '' }}">
                    <label for="Numero" class="control-label">Número</label>
                    <input for="Numero" class="form-control" type="text" name="numero" value="{{ isset($registro->numero) ? $registro->numero : old('numero') }}" />
                    @if($errors->has('numero'))
                        <small for="Numero" class="control-label">{{ $errors->first('numero') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group {{ $errors->has('complemento') ? 'has-error' : '' }}">
                    <label for="Complemento" class="control-label">Complemento</label>
                    <input for="Complemento" class="form-control" type="text" name="complemento" value="{{ isset($registro->complemento) ? $registro->complemento : old('complemento') }}"/>
                    @if($errors->has('complemento'))
                        <small for="Complemento" class="control-label">{{ $errors->first('complemento') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('bairro') ? 'has-error' : '' }}">
                    <label for="Bairro" class="control-label">Bairro</label>
                    <input for="Bairro" class="form-control" type="text" name="bairro" value="{{ isset($registro->bairro) ? $registro->bairro : old('bairro') }}" />
                    @if($errors->has('bairro'))
                        <small for="Bairro" class="control-label">{{ $errors->first('bairro') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('cidade') ? 'has-error' : '' }}">
                    <label for="Cidade" class="control-label">Cidade</label>
                    <input for="Cidade" class="form-control" type="text" name="cidade" value="{{ isset($registro->cidade) ? $registro->cidade : old('cidade') }}" />
                    @if($errors->has('cidade'))
                        <small for="Cidade" class="control-label">{{ $errors->first('cidade') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group {{ $errors->has('estado') ? 'has-error' : '' }}">
                    <label for="UF" class="control-label">UF</label>
                    <input type="text" name="hiddenEstadoSigla" value="{{ isset($registro->estado) ? $registro->estado : old('estado') }}" hidden>
                    <select id="comboEstado" for="UF" name="estado" class="form-control js-example-basic-single"></select>
                    @if($errors->has('estado'))
                        <small for="UF" class="control-label">{{ $errors->first('estado') }}</small>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
    