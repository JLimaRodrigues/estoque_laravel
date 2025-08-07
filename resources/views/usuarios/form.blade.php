@extends('layouts.admin')

@section('content-child')
    <div class="text-center">
        {{ isset($usuario) ? 'Editar Usuário' : 'Cadastrar Usuário' }}
    </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ isset($usuario) ? route('usuarios.atualizar', $usuario->id) : route('usuarios.criar') }}">
            @csrf
            @if(isset($usuario))
                @method('PUT')
            @endif

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Nome</label>
                    <input name="name" type="text" class="form-control" value="{{ old('name', $usuario->name ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label>E-mail</label>
                    <input name="email" type="email" class="form-control" value="{{ old('email', $usuario->email ?? '') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Senha</label>
                    <input name="password" type="password" class="form-control" {{ isset($usuario) ? '' : 'required' }}>
                    @if(isset($usuario))
                        <small class="text-muted">Deixe em branco para manter a senha atual</small>
                    @endif
                </div>
                <div class="col-md-6">
                    <label>Confirme a Senha</label>
                    <input name="password_confirmation" type="password" class="form-control" {{ isset($usuario) ? '' : 'required' }}>
                </div>
            </div>

            <div class="mb-3">
                <label>Nível de Perfil</label>
                <select name="nivel_perfil" class="form-select" required>
                    <option value="">Selecione</option>
                    @foreach(['cliente', 'funcionario', 'gerente', 'admin'] as $nivel)
                        <option value="{{ $nivel }}"
                            {{ old('nivel_perfil', $usuario->nivel_perfil ?? '') === $nivel ? 'selected' : '' }}>
                            {{ ucfirst($nivel) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('usuarios.index') }}" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-success">{{ isset($usuario) ? 'Atualizar' : 'Cadastrar' }}</button>
            </div>
        </form>
@endsection
