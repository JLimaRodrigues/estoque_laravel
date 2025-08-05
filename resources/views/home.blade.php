@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Dashboard</div>

    <div class="card-body">
        <h5>Bem-vindo, {{ Auth::user()->name }}!</h5>
        <p>Perfil: <strong>{{ Auth::user()->nivel_perfil }}</strong></p>

        @php
            $perfil = Auth::user()->nivel_perfil;
        @endphp

        @if ($perfil === 'cliente')
            <ul>
                <li><a href="{{ route('requisicoes.create') }}">Criar Requisição</a></li>
                <li><a href="{{ route('requisicoes.index') }}">Minhas Requisições</a></li>
            </ul>

        @elseif ($perfil === 'funcionario')
            <ul>
                <li><a href="{{ route('requisicoes.saida') }}">Dar Saída em Materiais</a></li>
            </ul>

        @elseif ($perfil === 'gerente')
            <ul>
                <li><a href="{{ route('requisicoes.saida') }}">Dar Saída em Materiais</a></li>
                <li><a href="{{ route('relatorios.index') }}">Relatórios Gerenciais</a></li>
            </ul>

        @elseif ($perfil === 'admin')
            <ul>
                <li><a href="{{ route('requisicoes.create') }}">Criar Requisição</a></li>
                <li><a href="{{ route('requisicoes.index') }}">Minhas Requisições</a></li>
                <li><a href="{{ route('requisicoes.saida') }}">Dar Saída em Materiais</a></li>
                <li><a href="{{ route('relatorios.index') }}">Relatórios Gerenciais</a></li>
                <li><a href="{{ route('admin.usuarios') }}">Gerenciar Usuários</a></li>
            </ul>

        @else
            <p>Perfil desconhecido. Contate o administrador.</p>
        @endif
    </div>
</div>
@endsection
