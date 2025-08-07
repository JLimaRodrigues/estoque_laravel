@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
    <div>
        Bem-vindo, <strong>{{ Auth::user()->name }}</strong> 
        <span class="badge bg-secondary text-light ms-2">{{ Auth::user()->nivel_perfil }}</span>
    </div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-sm btn-danger">Sair</button>
    </form>
    </div>

    <div class="card-body">
    <div class="row g-4 justify-content-center">

        @if(in_array(Auth::user()->nivel_perfil, ['cliente', 'admin']))
        <div class="col-md-3 text-center">
            <a href="{{ route('requisicoes.index') }}" class="icon-link">
                <i class="fas fa-list-alt text-primary"></i>
                <div>Minhas Requisições</div>
            </a>
        </div>
        <div class="col-md-3 text-center">
            <a href="{{ route('requisicoes.criar') }}" class="icon-link">
                <i class="fas fa-plus-circle text-success"></i>
                <div>Nova Requisição</div>
            </a>
        </div>
        @endif

        @if(in_array(Auth::user()->nivel_perfil, ['funcionario-comum', 'gerente', 'admin']))
        <div class="col-md-3 text-center">
            <a href="{{ route('requisicoes.saida') }}" class="icon-link">
                <i class="fas fa-truck text-warning"></i>
                <div>Saída de Material</div>
            </a>
        </div>
        @endif

        @if(in_array(Auth::user()->nivel_perfil, ['gerente', 'admin']))
        <div class="col-md-3 text-center">
            <a href="{{ route('produtos.index') }}" class="icon-link">
                <i class="fas fa-truck text-success"></i>
                <div>Produtos</div>
            </a>
        </div>
        @endif

        @if(in_array(Auth::user()->nivel_perfil, ['gerente', 'admin']))
        <div class="col-md-3 text-center">
            <a href="{{ route('relatorios.index') }}" class="icon-link">
                <i class="fas fa-chart-line text-info"></i>
                <div>Relatórios</div>
            </a>
        </div>
        @endif

        @if(Auth::user()->nivel_perfil === 'admin')
        <div class="col-md-3 text-center">
            <a href="{{ route('usuarios.index') }}" class="icon-link">
                <i class="fas fa-users-cog text-danger"></i>
                <div>Gerenciar Usuários</div>
            </a>
        </div>
        @endif

    </div>
    </div>
</div>
@endsection
