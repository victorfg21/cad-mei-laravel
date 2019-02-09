
<div class="box box-solid box-primary">
    <div class="box-header with-border"> 
        <h3 class="box-title">Dados Gerais</h3>
    </div>
    <div class="box-body">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="Nome" class="control-label">Nome</label>
            <input for="Nome" class="form-control" type="text" name="name" value="{{ isset($registro->name) ? $registro->name : old('name') }}" />
            @if($errors->has('name'))
                <small for="Nome" class="control-label">{{ $errors->first('name') }}</small>
            @endif
        </div>
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <label for="Email" class="control-label">Email</label>
        <input for="Email" class="form-control" type="text" name="email" value="{{ isset($registro->email) ? $registro->email : old('email') }}" {{ isset($registro->email) ? 'readonly' : '' }}/>
            @if($errors->has('email'))
                <small for="Email" class="control-label">{{ $errors->first('email') }}</small>
            @endif
        </div>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <label for="Senha" class="control-label">Senha</label>
            <input for="Senha" class="form-control" type="password" name="password" value="{{ isset($registro->password) ? $registro->password : '' }}" />
            @if($errors->has('password'))
                <small for="Senha" class="control-label">{{ $errors->first('password') }}</small>
            @endif
        </div>
        <div class="form-group {{ $errors->has('role_id') ? 'has-error' : '' }}">
            <label for="Permissao" class="control-label">Permissão</label>
            <select for="Permissao" class="form-control js-example-basic-single" name="role_id">
                <option value="" selected></option>
                @foreach ($permissao_list as $item => $permissao)
                    <option value="{{ $permissao->id }}">{{ $permissao->description }}</option>
                @endforeach
            </select>
            @if($errors->has('role_id'))
                <small for="Permissao" class="control-label">{{ $errors->first('role_id') }}</small>
            @endif
        </div>
    </div>
</div>